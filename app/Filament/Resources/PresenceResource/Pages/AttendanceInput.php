<?php

namespace App\Filament\Resources\PresenceResource\Pages;

use App\Filament\Resources\PresenceResource;
use App\Models\User;
use Filament\Resources\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class AttendanceInput extends Page
{
    protected static string $resource = PresenceResource::class;
    protected static string $view = 'filament.resources.presence-resource.pages.attendance-input';

    public $classroom;
    public $date;
    public $students = [];
    public $isEdit = false;

    public function mount(): void
    {
        $this->classroom = request()->get('classroom');
        $this->date = request()->get('date') ?? now()->format('Y-m-d');
        $this->isEdit = request()->has('date');
        $this->loadStudents();
    }

    public function loadStudents(): void
    {
        $students = User::role('student')
            ->where('classroom', $this->classroom)
            ->orderBy('name')
            ->get();
        if ($this->isEdit) {
            $presences = \App\Models\Presence::whereIn('user_id', $students->pluck('id'))
                ->whereDate('date', $this->date)
                ->get()->keyBy('user_id');
            $this->students = $students->map(function ($student) use ($presences) {
                $presence = $presences->get($student->id);
                return [
                    'id' => $student->id,
                    'nis' => $student->nis ?? '-',
                    'name' => $student->name,
                    'status' => $presence ? $presence->note : null
                ];
            })->toArray();
        } else {
            $this->students = $students->map(function ($student) {
                return [
                    'id' => $student->id,
                    'nis' => $student->nis ?? '-',
                    'name' => $student->name,
                    'status' => null
                ];
            })->toArray();
        }
    }

    public function save(): void
    {
        if (!$this->date || !$this->classroom) {
            Notification::make()
                ->title('Data tidak lengkap')
                ->body('Tanggal dan kelas harus diisi')
                ->danger()
                ->send();
            return;
        }
        foreach ($this->students as $student) {
            if (empty($student['status'])) {
                Notification::make()
                    ->title('Semua siswa harus dipilih kehadirannya!')
                    ->danger()
                    ->send();
                return;
            }
        }
        DB::beginTransaction();
        try {
            foreach ($this->students as $student) {
                if ($this->isEdit) {
                    \App\Models\Presence::updateOrCreate(
                        [
                            'user_id' => $student['id'],
                            'date' => \Carbon\Carbon::parse($this->date)->startOfDay(),
                        ],
                        [
                            'note' => $student['status'],
                        ]
                    );
                } else {
                    $exists = \App\Models\Presence::where('user_id', $student['id'])
                        ->whereDate('date', $this->date)
                        ->exists();
                    if ($exists) {
                        Notification::make()
                            ->title('Kehadiran untuk ' . $student['name'] . ' pada tanggal ini sudah ada!')
                            ->danger()
                            ->send();
                        continue;
                    }
                    if (isset($student['status']) && $student['status']) {
                        DB::table('presences')->insert([
                            'user_id' => $student['id'],
                            'date' => \Carbon\Carbon::parse($this->date)->startOfDay(),
                            'note' => $student['status'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
            DB::commit();
            Notification::make()
                ->title($this->isEdit ? 'Kehadiran berhasil diupdate' : 'Kehadiran berhasil disimpan')
                ->success()
                ->send();
            // Redirect handled by Filament or user
        } catch (\Exception $e) {
            DB::rollBack();
            Notification::make()
                ->title('Terjadi kesalahan')
                ->body('Gagal menyimpan kehadiran')
                ->danger()
                ->send();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Kembali')
                ->url(route('filament.admin.resources.presences.index'))
                ->icon('heroicon-o-arrow-left'),
        ];
    }
} 