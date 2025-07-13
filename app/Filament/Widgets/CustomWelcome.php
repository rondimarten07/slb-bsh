<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomWelcome extends BaseWidget
{

    protected static string $view = 'filament.widgets.custom-welcome';
    protected function getStats(): array
    {
        return [
            Stat::make('','')
        ];
    }
}
