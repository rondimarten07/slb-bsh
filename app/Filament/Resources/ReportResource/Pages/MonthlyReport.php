<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use App\Models\Report;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Filament\Resources\Pages\Page;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MonthlyReport extends Page
{
    protected static string $resource = ReportResource::class;

    protected static string $view = 'filament.resources.report-resource.pages.monthly-report';

    public $currentUser;
    public $members;
    public $selectedMonth;
    public $selectedUserId;
    public $reports;

    public function mount()
    {
        // Default to the current month
        $this->selectedMonth = Carbon::now()->format('Y-m');
        $this->selectedUserId = 11;
        $this->reports = [];
        $this->members = [];
        $this->currentUser = Auth::user();
        
        $this->fetchCurrentUser();
        // Fetch reports for the current month
        $this->fetchReports();
    }

    public function fetchReports()
    {
        $startOfMonth = Carbon::create($this->selectedMonth)->startOfMonth();
        $endOfMonth = Carbon::create($this->selectedMonth)->endOfMonth();

        // Get reports for the current month
        $reports = Report::whereBetween('date', [$startOfMonth, $endOfMonth])
            ->where('user_id', $this->selectedUserId)
            ->orderBy('date')
            ->get()
            ->keyBy('date');  // Key reports by date for easier lookup

        // Create a full list of dates for the selected month
        $datesInMonth = [];
        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $datesInMonth[] = [
                'date' => $date->format('Y-m-d'),
                'report' => $reports->get($date->format('Y-m-d')) // Retrieve report if exists, otherwise null
            ];
        }

        $this->reports = $datesInMonth; // Assign to $reports
    }

    public function fetchCurrentUser(){
        $this->currentUser = Auth::user();
                
        $members = User::all();
        if ($this->currentUser->hasRole('teacher')) { 
            $this->members = User::role(['student', 'teacher'])->where('classroom', $this->currentUser->classroom);
        }

        if ($this->currentUser->hasRole('staff')) {
            $this->members = User::role(['student', 'staff', 'teacher']);
        }

        if ($this->currentUser->hasRole('admin')) {
            $this->members = User::role(['student', 'staff']);
        }

        $this->members = $this->members->get();
    }

    protected function getViewData(): array
    {
        // Explicitly pass the data to the Blade view
        return [
            'reports' => $this->reports,
            'selectedMonth' => $this->selectedMonth,
            'members' => $this->members,
        ];
    }

    public function downloadPDF()
    {
        // Load the report data (similar to what you did for display)
        $startOfMonth = Carbon::create($this->selectedMonth)->startOfMonth();
        $endOfMonth = Carbon::create($this->selectedMonth)->endOfMonth();
        
        $reports = Report::where('user_id', $this->selectedUserId)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->orderBy('date')
            ->get();

        // Convert the report data and month/user information to pass into the view
        $data = [
            'reports' => $reports,
            'selectedMonth' => $this->selectedMonth,
            'selectedUser' => User::find($this->selectedUserId),
        ];

        // Load and render the PDF view
        $pdf = PDF::loadView('pdf.monthly-report', $data);
        
        // Return the generated PDF file as a download
        return response()->streamDownload(
            fn() => print($pdf->output()), 
            'monthly-report-' . $this->selectedMonth . '.pdf'
        );
    }
}
