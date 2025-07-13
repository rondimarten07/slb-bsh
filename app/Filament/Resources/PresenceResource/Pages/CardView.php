<?php

namespace App\Filament\Resources\PresenceResource\Pages;

use App\Filament\Resources\PresenceResource;
use App\Models\User;
use Filament\Resources\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Radio;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class CardView extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = PresenceResource::class;

    protected static string $view = 'filament.resources.presence-resource.pages.card-view';

    public $selectedClassroom = null;
    public $selectedDate = null;
    public $students = [];
    public $showModal = false;

    public function mount(): void
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function getClassroomOptions(): array
    {
        return User::role('student')
            ->whereNotNull('classroom')
            ->distinct()
            ->pluck('classroom', 'classroom')
            ->toArray();
    }

    public function openModal($classroom): void
    {
        $this->selectedClassroom = $classroom;
        $this->loadStudents($classroom);
        $this->showModal = true;
    }

    public function loadStudents($classroom): void
    {
        $students = User::role('student')
            ->where('classroom', $classroom)
            ->orderBy('name')
            ->get();

        $this->students = $students->map(function ($student) {
            return [
                'id' => $student->id,
                'nis' => $student->nis ?? '-',
                'name' => $student->name,
                'status' => null
            ];
        })->toArray();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->students = [];
        $this->selectedClassroom = null;
    }

    public function save(): void
    {
        if (!$this->selectedDate || !$this->selectedClassroom) {
            Notification::make()
                ->title('Data tidak lengkap')
                ->body('Tanggal dan kelas harus diisi')
                ->danger()
                ->send();
            return;
        }

        $hasData = false;
        foreach ($this->students as $student) {
            if (isset($student['status']) && $student['status']) {
                $hasData = true;
                break;
            }
        }

        if (!$hasData) {
            Notification::make()
                ->title('Data tidak lengkap')
                ->body('Minimal satu siswa harus memiliki status kehadiran')
                ->danger()
                ->send();
            return;
        }
        
        DB::beginTransaction();
        
        try {
            foreach ($this->students as $student) {
                if (isset($student['status']) && $student['status']) {
                    // Cek duplikasi kehadiran
                    $exists = \App\Models\Presence::where('user_id', $student['id'])
                        ->whereDate('date', $this->selectedDate)
                        ->exists();
                    if ($exists) {
                        Notification::make()
                            ->title('Kehadiran untuk ' . $student['name'] . ' pada tanggal ini sudah ada!')
                            ->danger()
                            ->send();
                        continue;
                    }
                    
                    DB::table('presences')->insert([
                        'user_id' => $student['id'],
                        'date' => \Carbon\Carbon::parse($this->selectedDate)->startOfDay(),
                        'note' => $student['status'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
            
            DB::commit();
            
            Notification::make()
                ->title('Kehadiran berhasil disimpan')
                ->success()
                ->send();
                
            $this->closeModal();
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            Notification::make()
                ->title('Terjadi kesalahan')
                ->body('Gagal menyimpan kehadiran')
                ->danger()
                ->send();
        }
    }

    public function getTitle(): string
    {
        return 'Kelas';
    }

    protected function getHeaderActions(): array
    {
        return [
            // List View button removed
        ];
    }
} 