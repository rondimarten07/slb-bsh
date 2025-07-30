<?php

namespace App\Filament\Resources\DonationResource\Widgets;

use App\Models\Donation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Number;
use Str;

class DonationOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $cashflow = Donation::groupBy('direction')
                        ->selectRaw('SUM(amount) AS sum, direction')
                        ->pluck('sum', 'direction');
        
        $last3Month = Donation::groupBy('direction')
                                ->selectRaw('SUM(amount) AS sum, direction')
                                ->whereBetween('date', [now()->startOfMonth()->subMonths(3), now()->endOfMonth()])
                                ->pluck('sum', 'direction');

        return [
            Stat::make('Sisa Donasi', Str::of(Number::currency(($cashflow['IN'] ?? 0) - ($cashflow['OUT'] ?? 0), 'IDR', 'id'))->replace(',00', '')),
            Stat::make('Total Pemasukan 3 Bulan Terakhir', Str::of(Number::currency($last3Month['IN'] ?? 0, 'IDR', 'id'))->replace(',00', '')),
            Stat::make('Total Pengeluaran 3 Bulan Terakhir', Str::of(Number::currency($last3Month['OUT'] ?? 0, 'IDR', 'id'))->replace(',00', '')),
        ];
    }
} 