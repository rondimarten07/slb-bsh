<?php

namespace App\Enums;
 
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
 
enum Cashflow: string implements HasLabel, HasColor, HasIcon
{
    case IN = 'IN';
    case OUT = 'OUT';
 
    public function getLabel(): ?string
    {
        return match ($this) {
            self::IN => 'Masuk',
            self::OUT => 'Keluar',
        };
    }
 
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::IN => 'success',
            self::OUT => 'danger',
        };
    }
 
    public function getIcon(): ?string
    {
        return match ($this) {
            self::IN => 'heroicon-m-chevron-down',
            self::OUT => 'heroicon-m-chevron-up',
        };
    }
}