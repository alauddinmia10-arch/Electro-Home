<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
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
            ->brandLogo(asset('images/logo-header.webp'))
            ->brandLogoHeight('2.5rem')
            ->maxContentWidth(\Filament\Support\Enums\Width::SevenExtraLarge)
            ->login()
            ->colors([
                'primary' => Color::Blue,
                'stat_green' => Color::Green,
                'stat_purple' => Color::hex('#290045'),
                'stat_orange' => Color::Orange,
                'stat_pink' => Color::hex('#004161'),
                'convert_action' => Color::hex('#0f766e'), // Deep Teal
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // Removed AccountWidget and FilamentInfoWidget as requested
            ])
            ->navigationGroups([
                'MASTER DATA',
                'MANAGEMENT',
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('3s')
            ->renderHook(
                \Filament\View\PanelsRenderHook::USER_MENU_BEFORE,
                fn (): \Illuminate\Contracts\View\View => view('filament.hooks.user-menu'),
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::USER_MENU_AFTER,
                fn (): \Illuminate\Support\HtmlString => new \Illuminate\Support\HtmlString('
                    <a href="' . url('/') . '" target="_blank" class="topbar-view-website-btn" title="View Website">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A11.954 11.954 0 0112 15.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0-.778-.099-1.533-.284-2.253" />
                        </svg>
                    </a>
                '),
            )
            ->plugins([
                \Awcodes\Curator\CuratorPlugin::make()
                    ->label('Media')
                    ->pluralLabel('Gallery')
                    ->navigationIcon('heroicon-o-photo')
                    ->navigationGroup('MANAGEMENT')
                    ->navigationSort(5),
            ])
            ->assets([
                \Filament\Support\Assets\Css::make('custom-admin-stylesheet', asset('css/custom-admin.css?v=84')),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
