<x-layouts.app>
    <div x-data="{ showMobileFilters: false }" class="max-w-[1600px] w-full mx-auto px-4 md:px-6 xl:px-[70px] py-8">
        <div class="flex flex-col md:flex-row gap-8">
            {{-- Mobile Filter Overlay --}}
            <div x-show="showMobileFilters" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="showMobileFilters = false"
                 class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" style="display: none;"></div>

            {{-- Left Sidebar: Filters --}}
            <aside class="w-72 max-w-[85vw] shrink-0 fixed inset-y-0 left-0 z-50 bg-white md:bg-transparent md:static md:w-64 -translate-x-full md:translate-x-0 transform transition-transform duration-300 overflow-y-auto md:overflow-visible h-full md:h-auto"
                   :class="showMobileFilters ? 'translate-x-0 shadow-2xl' : '-translate-x-full'">
                <div class="flex items-center justify-between p-4 md:hidden border-b border-gray-100 sticky top-0 bg-white z-10">
                    <h2 class="text-lg font-bold text-gray-800">Filters</h2>
                    <button type="button" @click="showMobileFilters = false" class="text-gray-500 hover:text-gray-800 bg-gray-100 rounded-full p-1.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form action="{{ route('shop') }}" method="GET" id="filter-form" class="space-y-6 bg-white p-5 md:rounded md:border border-gray-100 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-800 hidden md:block">Filters</h2>

                    {{-- Search --}}
                    <div>
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a]">
                    </div>
                    
                    {{-- Category --}}
                    <div>
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Category</label>
                        <select name="category" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a] bg-white">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Price Range --}}
                    <div x-data="priceRangeSlider({{ request('min_price') ?: 0 }}, {{ request('max_price') ?: (isset($maxPriceLimit) ? $maxPriceLimit : 500000) }}, 0, {{ isset($maxPriceLimit) ? $maxPriceLimit : 500000 }}, 100)">
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Price Range</label>
                        
                        {{-- Slider --}}
                        <div class="relative w-full h-1 mt-6 mb-8 flex items-center">
                            {{-- Track Background --}}
                            <div class="absolute w-full h-1 bg-gray-200 rounded-full"></div>
                            {{-- Active Track --}}
                            <div class="absolute h-1 bg-[#0b5c9a] rounded-full" x-bind:style="'left: ' + minPercent + '%; right: ' + (100 - maxPercent) + '%;'"></div>
                            
                            {{-- Native Range Inputs (Thumb only visible) --}}
                            <input type="range" step="100" x-bind:min="min" x-bind:max="max" x-model="minPrice" @input="updateFromSlider"
                                   class="absolute w-full pointer-events-none appearance-none bg-transparent" style="z-index: 30;">
                            <input type="range" step="100" x-bind:min="min" x-bind:max="max" x-model="maxPrice" @input="updateFromSlider"
                                   class="absolute w-full pointer-events-none appearance-none bg-transparent" style="z-index: 30;">
                            
                            <style>
                                input[type=range]::-webkit-slider-thumb {
                                    pointer-events: auto;
                                    width: 16px;
                                    height: 16px;
                                    -webkit-appearance: none;
                                    background-color: #0b5c9a;
                                    border-radius: 50%;
                                    cursor: pointer;
                                    position: relative;
                                    z-index: 40;
                                }
                                input[type=range]::-moz-range-thumb {
                                    pointer-events: auto;
                                    width: 16px;
                                    height: 16px;
                                    -moz-appearance: none;
                                    background-color: #0b5c9a;
                                    border: none;
                                    border-radius: 50%;
                                    cursor: pointer;
                                    position: relative;
                                    z-index: 40;
                                }
                                input[type=range]::-webkit-slider-runnable-track {
                                    background: transparent;
                                    border: transparent;
                                }
                                input[type=range]::-moz-range-track {
                                    background: transparent;
                                    border: transparent;
                                }
                            </style>
                        </div>
                        
                        {{-- Number Inputs --}}
                        <div class="flex items-center gap-2">
                            <input type="number" name="min_price" x-model="minPrice" @input="updateFromInput" placeholder="Min ৳" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a]">
                            <input type="number" name="max_price" x-model="maxPrice" @input="updateFromInput" placeholder="Max ৳" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a]">
                        </div>

                        <script>
                            document.addEventListener('alpine:init', () => {
                                if (!window.alpinePriceRangeSliderDefined) {
                                    window.alpinePriceRangeSliderDefined = true;
                                    Alpine.data('priceRangeSlider', (initialMin, initialMax, min, max, step) => ({
                                        minPrice: initialMin,
                                        maxPrice: initialMax,
                                        min: min,
                                        max: max,
                                        step: step,
                                        minPercent: 0,
                                        maxPercent: 100,
                                        init() {
                                            this.updatePercentages();
                                        },
                                        updateFromSlider() {
                                            this.minPrice = parseInt(this.minPrice);
                                            this.maxPrice = parseInt(this.maxPrice);
                                            if (this.minPrice > this.maxPrice) {
                                                let temp = this.minPrice;
                                                this.minPrice = this.maxPrice;
                                                this.maxPrice = temp;
                                            }
                                            this.updatePercentages();
                                        },
                                        updateFromInput() {
                                            this.minPrice = parseInt(this.minPrice);
                                            this.maxPrice = parseInt(this.maxPrice);
                                            if(this.minPrice < this.min) this.minPrice = this.min;
                                            if(this.maxPrice > this.max) this.maxPrice = this.max;
                                            this.updatePercentages();
                                        },
                                        updatePercentages() {
                                            this.minPercent = ((this.minPrice - this.min) / (this.max - this.min)) * 100;
                                            this.maxPercent = ((this.maxPrice - this.min) / (this.max - this.min)) * 100;
                                        }
                                    }));
                                }
                            });
                        </script>
                    </div>

                    {{-- Brand --}}
                    <div>
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Brand</label>
                        <select name="brand" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a] bg-white">
                            <option value="">All Brands</option>
                            @isset($brands)
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->slug ?? $brand->id }}" {{ request('brand') == ($brand->slug ?? $brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    {{-- On Sale Only --}}
                    <div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="on_sale" value="1" {{ request('on_sale') ? 'checked' : '' }} class="rounded border-gray-300 text-[#1877f2] focus:ring-[#1877f2]">
                            <span class="text-sm text-gray-600">On Sale Only</span>
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-[#0b5c9a] hover:bg-[#094d82] text-white text-[15px] font-semibold leading-none py-2 px-4 rounded transition-colors">Apply Filters</button>
                        <a href="{{ route('shop') }}" class="block text-center text-sm text-gray-500 hover:text-gray-800 mt-3">Clear Filters</a>
                    </div>
                </form>
            </aside>

            {{-- Right Content: Products Grid --}}
            <div class="flex-1">
                {{-- Top Header (Title, Breadcrumbs, Sort) --}}
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-[28px] font-bold text-gray-800 mb-1 leading-tight">
                            {{ $pageTitle }}
                        </h1>
                        <div class="flex items-center gap-1.5 text-[13px] text-gray-500">
                            <a href="{{ route('home') }}" class="text-[#0b5c9a] font-bold hover:underline">Home</a>
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="text-gray-600">{{ $pageTitle }}</span>
                        </div>
                    </div>

                    {{-- Sort Dropdowns --}}
                    <form id="sort-form" class="flex items-center gap-2">
                        @foreach(request()->except(['sort_by', 'sort_order', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        
                        <select name="sort_by" onchange="document.getElementById('sort-form').submit()" class="text-sm bg-white border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-[#0b5c9a] text-gray-700 shadow-sm cursor-pointer hover:border-gray-300">
                            <option value="name" {{ request('sort_by') === 'name' ? 'selected' : '' }}>Name</option>
                            <option value="price" {{ request('sort_by') === 'price' ? 'selected' : '' }}>Price</option>
                            <option value="newest" {{ request('sort_by', 'newest') === 'newest' ? 'selected' : '' }}>Newest</option>
                        </select>
                        @php
                            $currentSortBy = request('sort_by', 'newest');
                            
                            $ascLabel = 'A to Z';
                            $descLabel = 'Z to A';
                            
                            if ($currentSortBy === 'price') {
                                $ascLabel = 'Low to High';
                                $descLabel = 'High to Low';
                            } elseif ($currentSortBy === 'newest') {
                                $ascLabel = 'Oldest First';
                                $descLabel = 'Newest First';
                            }
                        @endphp
                        <select name="sort_order" onchange="document.getElementById('sort-form').submit()" class="text-sm bg-white border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-[#0b5c9a] text-gray-700 shadow-sm cursor-pointer hover:border-gray-300">
                            <option value="asc" {{ request('sort_order') === 'asc' ? 'selected' : '' }}>{{ $ascLabel }}</option>
                            <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>{{ $descLabel }}</option>
                        </select>
                    </form>
                </div>

                {{-- Toolbar (View, Columns) --}}
                <div class="flex items-center justify-between bg-white p-3 rounded border border-gray-100 shadow-sm mb-6">
                    <div class="flex items-center gap-3">
                        {{-- Mobile Filter Button --}}
                        <button type="button" @click="showMobileFilters = true" class="md:hidden flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 border border-gray-200 rounded text-sm font-medium text-gray-700 hover:bg-gray-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            Filter
                        </button>

                        {{-- View Toggle --}}
                        <div class="flex items-center gap-2">
                        <span class="text-[13px] text-gray-600 font-medium hidden sm:inline-block">View:</span>
                        <div class="flex items-center border border-gray-200 rounded overflow-hidden bg-gray-50">
                            <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}" class="p-2 {{ request('view', 'grid') === 'grid' ? 'bg-[#0b5c9a] text-white' : 'text-gray-500 hover:bg-gray-100' }}" title="Grid View">
                                <svg class="w-[18px] h-[18px]" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}" class="p-2 {{ request('view') === 'list' ? 'bg-[#0b5c9a] text-white' : 'text-gray-500 hover:bg-gray-100' }}" title="List View">
                                <svg class="w-[18px] h-[18px]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </div>
                    </div>
                    
                    {{-- Columns Toggle --}}
                    @if(request('view', 'grid') !== 'list')
                    <div class="hidden md:flex items-center gap-2">
                        <span class="text-[13px] text-gray-600 font-medium hidden sm:inline-block">Columns:</span>
                        <div class="flex items-center gap-1 border border-gray-200 rounded px-1 py-1 bg-white shadow-sm">
                            <a href="{{ request()->fullUrlWithQuery(['cols' => 4, 'view' => 'grid']) }}" class="px-2.5 py-1.5 rounded text-sm font-medium {{ request('cols', 4) == 4 && request('view', 'grid') != 'list' ? 'bg-[#0b5c9a] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-1.5 transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                  <rect x="5" y="5" width="6" height="6" rx="1" />
                                  <rect x="13" y="5" width="6" height="6" rx="1" />
                                  <rect x="5" y="13" width="6" height="6" rx="1" />
                                  <rect x="13" y="13" width="6" height="6" rx="1" />
                                </svg>
                                4
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['cols' => 5, 'view' => 'grid']) }}" class="px-2.5 py-1.5 rounded text-sm font-medium {{ request('cols') == 5 && request('view') != 'list' ? 'bg-[#0b5c9a] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-1.5 transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                  <rect x="3" y="5" width="4" height="6" rx="0.5" />
                                  <rect x="10" y="5" width="4" height="6" rx="0.5" />
                                  <rect x="17" y="5" width="4" height="6" rx="0.5" />
                                  <rect x="3" y="13" width="4" height="6" rx="0.5" />
                                  <rect x="10" y="13" width="4" height="6" rx="0.5" />
                                  <rect x="17" y="13" width="4" height="6" rx="0.5" />
                                </svg>
                                5
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['cols' => 6, 'view' => 'grid']) }}" class="px-2.5 py-1.5 rounded text-sm font-medium {{ request('cols') == 6 && request('view') != 'list' ? 'bg-[#0b5c9a] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-1.5 transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                  <rect x="3" y="3" width="4" height="4" rx="0.5" />
                                  <rect x="10" y="3" width="4" height="4" rx="0.5" />
                                  <rect x="17" y="3" width="4" height="4" rx="0.5" />
                                  <rect x="3" y="10" width="4" height="4" rx="0.5" />
                                  <rect x="10" y="10" width="4" height="4" rx="0.5" />
                                  <rect x="17" y="10" width="4" height="4" rx="0.5" />
                                  <rect x="3" y="17" width="4" height="4" rx="0.5" />
                                  <rect x="10" y="17" width="4" height="4" rx="0.5" />
                                  <rect x="17" y="17" width="4" height="4" rx="0.5" />
                                </svg>
                                6
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Products Grid --}}
                @if($products->count() > 0)
                    @php
                        // Determine grid layout based on view and cols parameters
                        $view = request('view', 'grid');
                        if ($view === 'list') {
                            $gridClass = 'grid-cols-1';
                        } else {
                            $cols = request('cols', 4);
                            $gridClass = 'grid-cols-2 lg:grid-cols-3';
                            if ($cols == 4) $gridClass .= ' xl:grid-cols-4';
                            if ($cols == 5) $gridClass .= ' xl:grid-cols-5';
                            if ($cols == 6) $gridClass .= ' xl:grid-cols-6';
                        }
                    @endphp
                    <div class="grid {{ $gridClass }} gap-3 md:gap-4">
                        @foreach($products as $product)
                            @include('partials.product-card', ['product' => $product, 'view' => $view])
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-8 flex justify-center">
                        {{ $products->links('pagination::tailwind') }}
                    </div>
                @else
                    <div class="bg-white rounded p-12 text-center border border-gray-100 shadow-sm">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">No products found</h3>
                        <p class="text-gray-500 mb-6 text-sm">Try adjusting your filters or search criteria.</p>
                        <a href="{{ route('shop') }}" class="btn btn-neutral inline-flex">Clear All Filters</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
