
            <span class="inline-flex items-center">
                <span>Dashboard</span>
                <span class="h-8 w-px bg-gray-300 dark:bg-gray-700" style="margin-left: 1rem; margin-right: 1rem;"></span>
                <span class="inline-flex items-center my-custom-btns" style="font-size: 1rem; font-weight: 500;">
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Brands\BrandResource::getUrl('index') }}" color="gray" icon="heroicon-o-plus-circle">Add Brand</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Categories\CategoryResource::getUrl('create') }}" color="gray" icon="heroicon-o-plus-circle">Add Category</x-filament::button>
                    <x-filament::button tag="a" href="{{ \App\Filament\Resources\Products\ProductResource::getUrl('create') }}" color="gray" icon="heroicon-o-plus-circle">Add Product</x-filament::button>
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
                .fi-main { padding: 0 0.75rem 0.75rem 0.75rem !important; } 
                .fi-header-heading { overflow: visible !important; }
                .my-custom-btns > * { margin-right: 1rem !important; min-width: 150px !important; justify-content: center !important; }
                .my-custom-btns > *:last-child { margin-right: 0 !important; }

                /* FORCE GLOBAL SEARCH WIDTH AND POSITION (ABSOLUTE) */
                @media (min-width: 1024px) {
                    .fi-global-search-ctn {
                        position: absolute !important;
                        left: 450px !important; /* Left gap as requested */
                        right: 400px !important; /* Right gap as requested */
                        width: auto !important;
                        max-width: 900px !important;
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
        