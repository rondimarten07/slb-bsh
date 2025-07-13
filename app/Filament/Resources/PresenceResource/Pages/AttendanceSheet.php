<?php

namespace App\Filament\Resources\PresenceResource\Pages;

use App\Filament\Resources\PresenceResource;
use App\Models\Presence;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Filament\Resources\Pages\Page;


class AttendanceSheet extends Page
{
    protected static string $resource = PresenceResource::class;

    protected static string $view = 'filament.resources.presence-resource.pages.attendance-sheet';

    public $selectedMonth;
    public $selectedClassroom;

    public function mount(){
        $this->selectedMonth = Carbon::now()->format('Y-m');
        $this->selectedClassroom = request()->get('classroom');
    }

    public function updateSelectedMonth()
    {
        // Rerender page when month is changed
        $this->render();
    }

    public function getStudentsProperty()
    {
        $query = User::role('student');
        if ($this->selectedClassroom) {
            $query->where('classroom', $this->selectedClassroom);
        }
        $students = $query->with(['presences' => function ($query) {
            $startOfMonth = Carbon::create($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::create($this->selectedMonth)->endOfMonth();
            $query->whereDate('date', '>=', $startOfMonth)
                  ->whereDate('date', '<=', $endOfMonth);
        }])
        ->orderBy('name')
        ->get();
        return $students;
    }

    public function getDatesInMonthProperty()
    {
        $startOfMonth = Carbon::create($this->selectedMonth)->startOfMonth();
        $endOfMonth = Carbon::create($this->selectedMonth)->endOfMonth();
        $dates = [];

        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $dates[] = $date->copy();
        }

        return $dates;
    }

    protected function getViewData(): array
    {
        // Explicitly pass the data to the Blade view
        return [
            // 'dates' => Presence::select('date')->distinct()->pluck('date')->sort()->values(),
            // 'students' => User::all()->where('role', 'student'),
            // 'attendanceData' => Presence::all()->groupBy('user_id'),

            'students' => $this->students,
            'datesInMonth' => $this->datesInMonth,
        ];
    }
}
