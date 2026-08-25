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
            <span class="inline-flex items-center flex-wrap" style="width: 100%;">
                <span style="font-weight: 600; font-size: 1.1rem; flex-shrink: 0;">Dashboard</span>
                <span class="header-divider h-8 w-px bg-gray-300 dark:bg-gray-700" style="margin-left: 1rem; margin-right: 1rem;"></span>
            </span>
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
                    .fi-header {
                        padding: 1rem !important;
                        margin-top: -0.25rem !important;
                        height: auto !important;
                    }
                    .header-divider {
                        display: none !important;
                    }
                    /* Action buttons arranged in 2x2 grid */
                    .fi-header-actions {
                        display: flex !important;
                        flex-wrap: wrap !important;
                        gap: 0.5rem !important;
                        width: 100% !important;
                        margin-top: 0.75rem !important;
                        justify-content: space-between !important;
                    }
                    .fi-header-actions .fi-btn {
                        flex: 0 0 calc(50% - 0.25rem) !important;
                        width: calc(50% - 0.25rem) !important;
                        justify-content: center !important;
                        margin: 0 !important;
                    }
                }

                /* FORCE GLOBAL SEARCH WIDTH AND POSITION (ABSOLUTE) ON DESKTOP */
                @media (min-width: 1024px) {
                    .fi-global-search-ctn {
                        position: absolute !important;
                        left: 450px !important;
                        right: 620px !important;
                        width: auto !important;
                        max-width: none !important;
                        transform: none !important;
                    }
                    /* On desktop, align header actions nicely */
                    .fi-header-actions {
                        gap: 1rem !important;
                    }
                    .fi-header-actions .fi-btn {
                        min-width: 150px !important;
                        justify-content: center !important;
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
            \Filament\Actions\Action::make('add_brand')
                ->label('Add Brand')
                ->icon('heroicon-o-plus-circle')
                ->color('gray')
                ->url(\App\Filament\Resources\Brands\BrandResource::getUrl('index')),

            \Filament\Actions\Action::make('add_category')
                ->label('Add Category')
                ->icon('heroicon-o-plus-circle')
                ->color('gray')
                ->url(\App\Filament\Resources\Categories\CategoryResource::getUrl('create')),

            \Filament\Actions\Action::make('add_product')
                ->label('Add Product')
                ->icon('heroicon-o-plus-circle')
                ->color('gray')
                ->url(\App\Filament\Resources\Products\ProductResource::getUrl('create')),

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
        ];
    }
}
