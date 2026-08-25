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
                <span class="my-custom-btns" style="display: flex; flex-wrap: wrap; align-items: center; font-size: 0.95rem; font-weight: 500;">
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Brands\BrandResource::getUrl(\'index\') }}" color="gray" icon="heroicon-o-plus-circle">Add Brand</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Categories\CategoryResource::getUrl(\'create\') }}" color="gray" icon="heroicon-o-plus-circle">Add Category</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Products\ProductResource::getUrl(\'create\') }}" color="gray" icon="heroicon-o-plus-circle">Add Product</x-filament::button>
                </span>
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
                
                @media (min-width: 1024px) {
                    .my-custom-btns > * { margin-right: 1rem !important; min-width: 150px !important; justify-content: center !important; }
                    .my-custom-btns > *:last-child { margin-right: 0 !important; }
                }

                @media (max-width: 1023px) {
                    .fi-header {
                        padding: 1rem !important;
                        margin-top: -0.25rem !important; /* Pull up to reduce extra space */
                        height: auto !important;
                    }
                    .header-divider {
                        display: none !important;
                    }
                    .hide-on-mobile {
                        display: none !important;
                    }
                    .my-custom-btns {
                        margin-top: 0.75rem;
                        gap: 0.5rem;
                        width: 100%;
                        justify-content: space-between !important;
                    }
                    .my-custom-btns > * {
                        margin-right: 0 !important;
                        flex: 0 0 calc(50% - 0.25rem) !important;
                        width: calc(50% - 0.25rem) !important;
                        justify-content: center !important;
                    }
                    /* Action buttons container hidden if moved by JS */
                    .fi-header-actions {
                        margin-top: 0.5rem !important;
                    }
                }

                /* FORCE GLOBAL SEARCH WIDTH AND POSITION (ABSOLUTE) ON DESKTOP */
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
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    function arrangeMobileGrid() {
                        if (window.innerWidth < 1024) {
                            const actionsContainer = document.querySelector(".fi-header-actions");
                            const customBtns = document.querySelector(".my-custom-btns");
                            
                            // Move actions into custom-btns to create a unified 2x2 grid
                            if (actionsContainer && customBtns) {
                                Array.from(actionsContainer.children).forEach(function(child) {
                                    customBtns.appendChild(child);
                                });
                            }
                        }
                    }
                    
                    // Run once immediately if ready
                    arrangeMobileGrid();
                    // Also hook into Livewire navigate if needed
                    document.addEventListener("livewire:navigated", arrangeMobileGrid);
                });
            </script>
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
                ->openUrlInNewTab()
                ->extraAttributes(['class' => 'hide-on-mobile']),
        ];
    }
}
