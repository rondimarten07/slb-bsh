<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use Filament\Resources\Pages\Page;

class Faq extends Page
{
    protected static string $resource = FaqResource::class;

    protected static string $view = 'filament.resources.presence-resource.pages.faq';

    protected static ?string $title = 'FAQ';
} 