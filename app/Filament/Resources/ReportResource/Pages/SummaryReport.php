<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use App\Models\Report;
use App\Models\User;
use Filament\Resources\Pages\Page;

class SummaryReport extends Page
{
    protected static string $resource = ReportResource::class;

    protected static string $view = 'filament.resources.report-resource.pages.summary-report';

    function getViewData(): array
    {
        $students = User::all();
        // dd($students->pluck('id', 'name'));
                            // ->where('classroom', auth()->user()->classroom);
        return [
            'reports' => Report::whereIn('user_id', $students->pluck('id'))->get(),
        ];
    }
}
