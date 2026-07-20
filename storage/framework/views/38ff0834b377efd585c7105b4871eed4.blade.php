
            <div class="flex items-center gap-4">
                <span>Dashboard</span>
                <div class="flex items-center gap-2" style="font-size: 1rem; font-weight: 500;">
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Brands\BrandResource::getUrl('index') }}" color="info" icon="heroicon-o-plus-circle" size="sm">Add Brand</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Categories\CategoryResource::getUrl('create') }}" color="warning" icon="heroicon-o-plus-circle" size="sm">Add Category</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Products\ProductResource::getUrl('create') }}" color="primary" icon="heroicon-o-plus-circle" size="sm">Add Product</x-filament::button>
                </div>
            </div>
            <style>.fi-main { padding: 0.75rem !important; } .fi-header-heading { overflow: visible !important; }</style>
        