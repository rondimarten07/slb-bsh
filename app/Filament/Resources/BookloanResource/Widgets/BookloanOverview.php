<?php

namespace App\Filament\Resources\BookloanResource\Widgets;

use App\Models\Bookloan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookloanOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Peminjaman', Bookloan::count()),
            Stat::make('Sudah Dikembalikan', Bookloan::where('returned', true)->get()->count()),
            Stat::make('Belum Dikembalikan', Bookloan::where('returned', false)->get()->count())
        ];
    }
}
