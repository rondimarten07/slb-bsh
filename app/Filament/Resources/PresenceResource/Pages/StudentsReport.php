<?php

namespace App\Filament\Resources\PresenceResource\Pages;

use App\Filament\Resources\PresenceResource;
use Filament\Resources\Pages\Page;

class StudentsReport extends Page
{
    protected static string $resource = PresenceResource::class;

    protected static string $view = 'filament.resources.presence-resource.pages.students-report';
}
