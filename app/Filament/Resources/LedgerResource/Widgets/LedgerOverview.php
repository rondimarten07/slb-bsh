<?php

namespace App\Filament\Resources\LedgerResource\Widgets;

use App\Models\Ledger;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Number;
use Str;

class LedgerOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $cashflow = Ledger::groupBy('direction')
                        ->selectRaw('SUM(amount) AS sum, direction')
                        ->pluck('sum', 'direction');
        
        $last3Month = Ledger::groupBy('direction')
                                ->selectRaw('SUM(amount) AS sum, direction')
                                ->whereBetween('date', [now()->startOfMonth()->subMonths(3), now()->endOfMonth()])
                                ->pluck('sum', 'direction');

        // dd($last3Month);
        
        return [
            Stat::make('Sisa Kas Sekolah', Str::of(Number::currency($cashflow['IN'] - $cashflow['OUT'], 'IDR', 'id'))->replace(',00', '')),
            Stat::make('Total Pemasukan 3 Bulan Terakhir', Str::of(Number::currency($last3Month['IN'] ?? 0, 'IDR', 'id'))->replace(',00', '')),
            Stat::make('Total Pengeluaran 3 Bulan Terakhir', Str::of(Number::currency($last3Month['OUT'] ?? 0, 'IDR', 'id'))->replace(',00', '')),
        ];
    }
}
