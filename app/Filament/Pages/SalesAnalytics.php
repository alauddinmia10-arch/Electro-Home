<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SalesAnalytics extends Page
{
    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-chart-bar';
    }

    protected static string|\UnitEnum|null $navigationGroup = 'MANAGEMENT';
    protected static ?int $navigationSort = 1;

    

    protected string $view = 'filament.pages.sales-analytics';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\SalesAnalyticsChart::class,
        ];
    }
}
