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
            <span class="dashboard-header-wrapper" style="display: flex; align-items: center; width: 100%;">
                <span style="font-weight: 800; font-size: 1.25rem; color: #111827; letter-spacing: -0.025em;">Dashboard</span>
                <span class="header-divider" style="height: 2rem; width: 1px; background-color: #d1d5db; margin-left: 1rem; margin-right: 1rem;"></span>
                <span class="my-custom-btns" style="display: flex; align-items: center; font-size: 1rem; font-weight: 500;">
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Brands\BrandResource::getUrl(\'index\') }}" color="success" icon="heroicon-o-tag" outlined class="custom-action-btn">Add Brand</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Categories\CategoryResource::getUrl(\'create\') }}" color="info" icon="heroicon-o-folder-plus" outlined class="custom-action-btn">Add Category</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Products\ProductResource::getUrl(\'create\') }}" color="warning" icon="heroicon-o-cube" outlined class="custom-action-btn">Add Product</x-filament::button>
                </span>
            </span>
            <style>
                .fi-header { 
                    background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%) !important;
                    border: 1px solid #dcfce7 !important;
                    border-radius: 1rem; 
                    padding: 0.5rem 1rem !important; 
                    min-height: 4rem !important; 
                    margin-top: -1.25rem !important; 
                    margin-bottom: 1rem !important;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05) !important;
                }
                .fi-main { padding: 0 0.75rem 0.75rem 0.75rem !important; } 
                .fi-header-heading { overflow: visible !important; width: 100% !important; }
                
                .my-custom-btns {
                    gap: 0.75rem;
                }
                
                @media (min-width: 768px) {
                    .my-custom-btns > * { min-width: 140px !important; justify-content: center !important; }
                }

                @media (max-width: 1023px) {
                    .fi-header {
                        padding: 1.25rem 1rem !important;
                        margin-top: 1rem !important; /* give space for absolute search bar */
                        height: auto !important;
                    }
                    .dashboard-header-wrapper {
                        flex-direction: column !important;
                        align-items: flex-start !important;
                    }
                    .header-divider {
                        display: none !important;
                    }
                    .my-custom-btns {
                        display: grid !important;
                        grid-template-columns: repeat(3, minmax(0, 1fr));
                        gap: 0.5rem;
                        width: 100%;
                        margin-top: 1rem;
                    }
                    .custom-action-btn {
                        margin-right: 0 !important;
                        padding: 0.5rem 0.25rem !important;
                        flex-direction: column !important;
                        justify-content: center !important;
                        align-items: center !important;
                        height: auto !important;
                        border-radius: 0.75rem !important;
                        background: #ffffff !important;
                        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
                    }
                    .custom-action-btn svg {
                        width: 1.5rem !important;
                        height: 1.5rem !important;
                        margin-right: 0 !important;
                        margin-bottom: 0.25rem !important;
                    }
                    .custom-action-btn span {
                        font-size: 0.7rem !important;
                        line-height: 1.1 !important;
                        text-align: center !important;
                        white-space: normal !important;
                    }
                    /* Filament Header Actions */
                    .fi-header-actions {
                        display: grid !important;
                        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                        gap: 0.5rem !important;
                        width: 100% !important;
                        margin-top: 0.5rem !important;
                    }
                    .fi-header-actions .fi-btn {
                        width: 100% !important;
                        justify-content: center !important;
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
