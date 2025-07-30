<?php

namespace App\Filament\Resources\PaycheckResource\Pages;

use App\Filament\Resources\PaycheckResource;
use Filament\Resources\Pages\Page;

class Paycheck extends Page
{
    protected static string $resource = PaycheckResource::class;

    protected static string $view = 'filament.resources.presence-resource.pages.paycheck';

    protected static ?string $title = 'Slip Gaji';
} 