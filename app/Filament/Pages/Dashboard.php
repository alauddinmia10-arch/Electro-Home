<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-home';
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return new \Illuminate\Support\HtmlString(\Illuminate\Support\Facades\Blade::render('
            <span class="inline-flex items-center">
                <span>Dashboard</span>
                <span class="h-8 w-px bg-gray-300 dark:bg-gray-700" style="margin-left: 1rem; margin-right: 1rem;"></span>
                <span class="inline-flex items-center my-custom-btns" style="font-size: 1rem; font-weight: 500;">
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Brands\BrandResource::getUrl(\'index\') }}" color="stat_pink" icon="heroicon-o-plus-circle" class="!text-white" style="background-color: #0284c7 !important; border-color: #0284c7 !important;">Add Brand</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Categories\CategoryResource::getUrl(\'create\') }}" color="stat_green" icon="heroicon-o-plus-circle" class="!text-white" style="background-color: #16a34a !important; border-color: #16a34a !important;">Add Category</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Products\ProductResource::getUrl(\'create\') }}" color="info" icon="heroicon-o-plus-circle" class="!text-white" style="background-color: #3b82f6 !important; border-color: #3b82f6 !important;">Add Product</x-filament::button>
                </span>
            </span>
            <style>
                .fi-header { padding-top: 0.25rem !important; padding-bottom: 0.25rem !important; min-height: 3.5rem !important; margin-top: -1.25rem !important; }
                .fi-main { padding: 0 0.75rem 0.75rem 0.75rem !important; } 
                .fi-header-heading { overflow: visible !important; }
                .my-custom-btns a, .my-custom-btns button, .my-custom-btns span, .my-custom-btns svg { color: #ffffff !important; }
                .my-custom-btns > * { margin-right: 1rem !important; min-width: 150px !important; justify-content: center !important; }
                .my-custom-btns > *:last-child { margin-right: 0 !important; }
            </style>
        '));
    }

    public function getColumns(): int | array
    {
        return [
            'default' => 1,
            'md' => 2,
            'lg' => 3,
            'xl' => 3,
            '2xl' => 3,
        ];
    }

    public function getMaxContentWidth(): string | \Filament\Support\Enums\Width | null
    {
        return 'full';
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('go_to_home')
                ->label('View Website')
                ->icon('heroicon-o-globe-alt')
                ->color('gray')
                ->url(url('/'))
                ->openUrlInNewTab(),
        ];
    }
}
