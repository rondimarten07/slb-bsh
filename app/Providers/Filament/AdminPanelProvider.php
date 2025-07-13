<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\CustomWelcome::class,
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            // ->navigationItems([
            //     NavigationItem::make('QR Absensi')
            //         ->icon('heroicon-o-qr-code')
            //         ->sort(50)
            //         ->url(fn():string => route('filament.admin.resources.presences.qr'))
            //         ->visible(fn() => auth()->user()->hasRole('teacher'))
            //         // ->hidden(),
            // ])
            ->navigationItems([
                NavigationItem::make('FAQ')
                    ->icon('heroicon-o-information-circle')
                    ->sort(51)
                    ->url(fn():string => route('filament.admin.resources.presences.faq'))
                    ->visible(fn() => auth()->user()->hasAnyRole(['teacher', 'staff']))
            ]) 
            ->navigationItems([
                NavigationItem::make('Slip Gaji')
                    ->icon('heroicon-o-banknotes')
                    ->sort(53)
                    ->url(fn():string => route('filament.admin.resources.presences.paycheck'))
                    ->visible(fn() => auth()->user()->hasAnyRole(['staff', 'admin']))
            ]);
    }
}
