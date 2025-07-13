<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = [
            Stat::make('Jumlah Siswa', User::whereHas('roles', fn ($q) => $q->where('name', 'student'))->get()->count()),
            Stat::make('Jumlah Guru', User::whereHas('roles', fn ($q) => $q->where('name', 'teacher'))->get()->count()),
            Stat::make('Jumlah Staff', User::whereHas('roles', fn ($q) => $q->where('name', 'staff'))->get()->count()),
        ];

        switch (auth()->user()->getRoleNames()->first()) {
            case 'teacher':
                return array_filter($stats, function (Stat $stat) {
                    return $stat->getLabel() !== 'Jumlah Staff';
                });
            case 'staff':
                return array_filter($stats, function (Stat $stat) {
                    return $stat->getLabel() !== 'Jumlah Guru' && $stat->getLabel() !== 'Jumlah Siswa';
                });
            default:
                return $stats;
        }

        if (! auth()->user()->hasAnyRole(['admin', 'staff'])) {
            // remove it by label:
            $stats = array_filter($stats, function (Stat $stat) {
                return $stat->getLabel() !== 'Jumlah Siswa';
            });
        }

        return $stats;
    }
}
