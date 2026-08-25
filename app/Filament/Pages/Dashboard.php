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
            <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 1rem;">
                <span style="font-weight: 700; font-size: 1.3rem; flex-shrink: 0; color: #111827;">Dashboard</span>
                <span class="header-divider h-8 w-px bg-gray-300 dark:bg-gray-700" style="flex-shrink: 0;"></span>
                <div class="my-custom-btns" style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 500;">
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Brands\BrandResource::getUrl(\'index\') }}" color="gray" icon="heroicon-o-plus-circle">Add Brand</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Categories\CategoryResource::getUrl(\'create\') }}" color="gray" icon="heroicon-o-plus-circle">Add Category</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Products\ProductResource::getUrl(\'create\') }}" color="gray" icon="heroicon-o-plus-circle">Add Product</x-filament::button>
                </div>
            </div>
            <style>
                .fi-header { 
                    background-color: #eaf7ec !important; 
                    border-radius: 0.75rem; 
                    padding: 0.5rem 1rem !important; 
                    min-height: 4rem !important; 
                    margin-top: -1.25rem !important; 
                    margin-bottom: 0.75rem !important;
                }
                .fi-main { padding-top: 0 !important; padding-left: 0.75rem !important; padding-right: 0.75rem !important; padding-bottom: 0.75rem !important; } 
                .fi-header-heading { overflow: visible !important; width: 100% !important; }
                
                @media (max-width: 1023px) {
                    /* Hide the View Website action on mobile and tablet since topbar globe exists */
                    #view-website-btn-action { display: none !important; }
                    /* Hide the Filament action wrapper if it exists using CSS :has() */
                    .fi-header-actions *:has(> #view-website-btn-action) { display: none !important; }
                }
                
                @media (max-width: 767px) {
                    .header-divider { display: none !important; }
                    .hide-on-mobile { display: none !important; }

                    .fi-header {
                        display: grid !important;
                        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                        gap: 0.5rem !important;
                    }

                    /* Strip structural wrappers to flatten DOM into the grid */
                    .fi-header > div:first-child,
                    .fi-header-heading,
                    .fi-header-heading > div,
                    .my-custom-btns,
                    .my-custom-btns div,
                    .fi-header-actions-ctn,
                    .fi-header-actions-ctn div {
                        display: contents !important;
                    }

                    /* Dashboard title full width */
                    .fi-header-heading > div > span:first-child {
                        grid-column: span 2 !important;
                        margin-bottom: 0 !important;
                        display: block !important;
                    }

                    /* Force actual buttons to stretch and center */
                    .my-custom-btns button, .my-custom-btns a, .my-custom-btns .fi-btn,
                    .fi-header-actions-ctn button, .fi-header-actions-ctn a, .fi-header-actions-ctn .fi-btn {
                        width: 100% !important;
                        max-width: 100% !important;
                        justify-content: center !important;
                        text-align: center !important;
                        display: flex !important;
                    }
                }
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
            \Filament\Actions\Action::make('generate_landing_page')
                ->label('Landing Page')
                ->icon('heroicon-o-link')
                ->color('gray')
                ->form([
                    \Filament\Forms\Components\Select::make('category_id')
                        ->label('Select Category (Optional)')
                        ->options(\App\Models\Category::pluck('name', 'id'))
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(fn (callable $set) => $set('product_id', null)),
                    \Filament\Forms\Components\Select::make('product_id')
                        ->label('Select Product for Landing Page')
                        ->options(function (callable $get) {
                            $categoryId = $get('category_id');
                            if ($categoryId) {
                                $categoryIds = \App\Models\Category::where('id', $categoryId)->orWhere('parent_id', $categoryId)->pluck('id');
                                return \App\Models\Product::whereIn('category_id', $categoryIds)->pluck('name', 'id');
                            }
                            return \App\Models\Product::pluck('name', 'id');
                        })
                        ->searchable()
                        ->required(),
                ])
                ->action(function (array $data) {
                    $product = \App\Models\Product::find($data['product_id']);
                    if ($product) {
                        return redirect()->to(route('landing.page', ['slug' => $product->slug]));
                    }
                }),
            \Filament\Actions\Action::make('view_website')
                ->label('View Website')
                ->icon('heroicon-o-globe-alt')
                ->color('gray')
                ->url(route('home'))
                ->openUrlInNewTab()
                ->extraAttributes(['id' => 'view-website-btn-action']),
        ];
    }
}
