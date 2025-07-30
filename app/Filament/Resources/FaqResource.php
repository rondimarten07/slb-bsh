<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;

class FaqResource extends Resource
{
    protected static ?string $model = null;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'FAQ';

    protected static ?string $modelLabel = 'FAQ';

    protected static ?string $pluralModelLabel = 'FAQ';

    public static function getPages(): array
    {
        return [
            'index' => Pages\Faq::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['teacher', 'staff', 'treasurer']);
    }
} 