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

    public function mount(){
        // Set default to the current month
        $this->selectedMonth = Carbon::now()->format('Y-m');
    }

    public function updateSelectedMonth()
    {
        // Rerender page when month is changed
        $this->render();
    }

    public function getStudentsProperty()
    {

        $user = Auth::user();
                
        $members = User::all();
        if ($user->hasRole('teacher')) { 
            $members = User::role(['student'])->where('classroom', $user->classroom);
        }

        if ($user->hasRole('staff')) {
            $members = User::role(['student', 'staff', 'teacher']);
        }

        if ($user->hasRole('admin')) {
            $members = User::role(['student', 'staff']);
        }

        return User::whereIn('id', $members->pluck('id'))->with(['presences' => function ($query) {
            $startOfMonth = Carbon::create($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::create($this->selectedMonth)->endOfMonth();
            $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        }])->get();
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
