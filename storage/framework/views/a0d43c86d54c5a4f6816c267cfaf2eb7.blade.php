
            <span class="inline-flex items-center gap-8">
                <span>Dashboard</span>
                <span class="inline-flex items-center gap-2" style="font-size: 1rem; font-weight: 500;">
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Brands\BrandResource::getUrl('index') }}" color="stat_pink" icon="heroicon-o-plus-circle" size="sm">Add Brand</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Categories\CategoryResource::getUrl('create') }}" color="stat_green" icon="heroicon-o-plus-circle" size="sm">Add Category</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Products\ProductResource::getUrl('create') }}" color="primary" icon="heroicon-o-plus-circle" size="sm">Add Product</x-filament::button>
                </span>
            </span>
            <style>.fi-main { padding: 0.75rem !important; } .fi-header-heading { overflow: visible !important; }</style>
        