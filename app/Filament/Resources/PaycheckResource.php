<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaycheckResource\Pages;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;

class PaycheckResource extends Resource
{
    protected static ?string $model = null;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Slip Gaji';

    protected static ?string $modelLabel = 'Slip Gaji';

    protected static ?string $pluralModelLabel = 'Slip Gaji';

    public static function getPages(): array
    {
        return [
            'index' => Pages\Paycheck::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['staff', 'admin', 'treasurer']);
    }
} 