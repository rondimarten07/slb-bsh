<?php

namespace App\Filament\Resources\BookloanResource\Pages;

use App\Filament\Resources\BookloanResource;
use App\Filament\Resources\BookloanResource\Widgets\BookloanOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookloans extends ListRecords
{
    protected static string $resource = BookloanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BookloanOverview::class
        ];
    }
}
