<?php

namespace App\Filament\Resources\BookloanResource\Pages;

use App\Filament\Resources\BookloanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookloan extends EditRecord
{
    protected static string $resource = BookloanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
