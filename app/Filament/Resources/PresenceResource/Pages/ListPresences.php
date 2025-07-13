<?php

namespace App\Filament\Resources\PresenceResource\Pages;

use App\Filament\Resources\PresenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPresences extends ListRecords
{
    protected static string $resource = PresenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('card')
                ->label('Card View')
                ->url(route('filament.admin.resources.presences.index'))
                ->icon('heroicon-o-squares-2x2'),
        ];
    }
}
