<?php

namespace App\Filament\Resources\BookloanResource\Pages;

use App\Filament\Resources\BookloanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBookloan extends ViewRecord
{
    protected static string $resource = BookloanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
