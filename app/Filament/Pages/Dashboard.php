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
            <span class="flex flex-col md:flex-row md:items-center">
                <span class="font-bold text-lg mb-2 md:mb-0">Dashboard</span>
                <span class="hidden md:block h-8 w-px bg-gray-300 dark:bg-gray-700 mx-4"></span>
                <span class="grid grid-cols-2 sm:grid-cols-3 md:flex gap-2 md:gap-4 my-custom-btns text-base font-medium w-full md:w-auto">
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Brands\BrandResource::getUrl(\'index\') }}" color="gray" icon="heroicon-o-plus-circle">Add Brand</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Categories\CategoryResource::getUrl(\'create\') }}" color="gray" icon="heroicon-o-plus-circle">Add Category</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Products\ProductResource::getUrl(\'create\') }}" color="gray" icon="heroicon-o-plus-circle">Add Product</x-filament::button>
                </span>
            </span>
            <style>
                .fi-header { 
                    background-color: #eaf7ec !important; 
                    border-radius: 0.75rem; 
                    padding: 1rem !important; 
                    min-height: auto !important; 
                    margin-top: 0 !important; 
                    margin-bottom: 0.75rem !important;
                }
                
                @media (min-width: 768px) {
                    .fi-header {
                        padding: 0.5rem 1rem !important; 
                        min-height: 4rem !important; 
                        margin-top: -1.25rem !important; 
                    }
                }
                
                .fi-main { padding: 0 0.75rem 0.75rem 0.75rem !important; } 
                .fi-header-heading { overflow: visible !important; width: 100% !important; }
                
                @media (min-width: 768px) {
                    .my-custom-btns > * { min-width: 150px !important; justify-content: center !important; }
                }
                
                @media (max-width: 767px) {
                    .my-custom-btns {
                        width: 100% !important;
                    }
                    .my-custom-btns > * {
                        padding: 0.25rem !important;
                        font-size: 0.85rem !important;
                    }
                }

                /* FORCE GLOBAL SEARCH WIDTH AND POSITION (ABSOLUTE) */
                @media (min-width: 1024px) {
                    .fi-global-search-ctn {
                        position: absolute !important;
                        left: 450px !important; /* Left gap as requested */
                        right: 620px !important; /* Adjusted to 620px to match the red circle */
                        width: auto !important;
                        max-width: none !important;
                        transform: none !important;
                    }
                }
                .fi-global-search,
                .fi-global-search-field,
                .fi-global-search-field .fi-input-wrapper,
                .fi-global-search-input {
                    width: 100% !important;
                    max-width: 100% !important;
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
            \Filament\Actions\Action::make('go_to_home')
                ->label('View Website')
                ->icon('heroicon-o-globe-alt')
                ->color('gray')
                ->url(url('/'))
                ->openUrlInNewTab(),
        ];
    }
}
