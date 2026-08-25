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
            ->userMenuItems([
                'profile' => \Filament\Navigation\MenuItem::make()
                    ->label(fn () => new \Illuminate\Support\HtmlString('
                        <div style="display: flex; flex-direction: column; line-height: 1.2;">
                            <span style="font-weight: 600; color: #111827; font-size: 0.95rem;">' . filament()->auth()->user()->name . '</span>
                            <span style="font-size: 0.7rem; color: #6b7280; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 4px;">' . match(filament()->auth()->user()->role ?? 'admin') {
                                'super_admin' => 'Administrator',
                                'admin' => 'Admin',
                                'manager' => 'Manager',
                                default => 'Administrator'
                            } . '</span>
                        </div>
                    '))
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::USER_MENU_BEFORE,
                fn (): \Illuminate\Contracts\View\View => view('filament.hooks.user-menu'),
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
                \Filament\Support\Assets\Css::make('custom-admin-stylesheet', asset('css/custom-admin.css?v=83')),
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
