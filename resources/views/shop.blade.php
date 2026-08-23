<x-layouts.app>
    <div class="max-w-[1600px] w-full mx-auto px-4 md:px-6 xl:px-[70px] py-8">
        <div class="flex flex-col md:flex-row gap-8">
            {{-- Left Sidebar: Filters --}}
            <aside class="w-full md:w-64 shrink-0">
                <form action="{{ route('shop') }}" method="GET" id="filter-form" class="space-y-6 bg-white p-5 rounded border border-gray-100 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-800">Filters</h2>

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
                    <div>
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Price Range</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min ৳" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a]">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max ৳" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a]">
                        </div>
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
                        <select name="sort_order" onchange="document.getElementById('sort-form').submit()" class="text-sm bg-white border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-[#0b5c9a] text-gray-700 shadow-sm cursor-pointer hover:border-gray-300">
                            <option value="asc" {{ request('sort_order') === 'asc' ? 'selected' : '' }}>A to Z</option>
                            <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>Z to A</option>
                        </select>
                    </form>
                </div>

                {{-- Toolbar (View, Columns) --}}
                <div class="flex items-center justify-between bg-white p-3 rounded border border-gray-100 shadow-sm mb-6">
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
                    
                    {{-- Columns Toggle --}}
                    <div class="flex items-center gap-2">
                        <span class="text-[13px] text-gray-600 font-medium hidden sm:inline-block">Columns:</span>
                        <div class="flex items-center gap-1 border border-gray-200 rounded px-1 py-1 bg-white shadow-sm">
                            <a href="{{ request()->fullUrlWithQuery(['cols' => 4]) }}" class="px-2.5 py-1.5 rounded text-sm font-medium {{ request('cols', 4) == 4 ? 'bg-[#0b5c9a] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-1.5 transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                  <rect x="5" y="5" width="6" height="6" rx="1" />
                                  <rect x="13" y="5" width="6" height="6" rx="1" />
                                  <rect x="5" y="13" width="6" height="6" rx="1" />
                                  <rect x="13" y="13" width="6" height="6" rx="1" />
                                </svg>
                                4
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['cols' => 5]) }}" class="px-2.5 py-1.5 rounded text-sm font-medium {{ request('cols') == 5 ? 'bg-[#0b5c9a] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-1.5 transition-colors">
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
                            <a href="{{ request()->fullUrlWithQuery(['cols' => 6]) }}" class="px-2.5 py-1.5 rounded text-sm font-medium {{ request('cols') == 6 ? 'bg-[#0b5c9a] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-1.5 transition-colors">
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
                </div>

                {{-- Products Grid --}}
                @if($products->count() > 0)
                    @php
                        // Determine grid layout based on cols parameter
                        $cols = request('cols', 4);
                        $gridClass = 'grid-cols-2 lg:grid-cols-3';
                        if ($cols == 4) $gridClass .= ' xl:grid-cols-4';
                        if ($cols == 5) $gridClass .= ' xl:grid-cols-5';
                        if ($cols == 6) $gridClass .= ' xl:grid-cols-6';
                    @endphp
                    <div class="grid {{ $gridClass }} gap-3 md:gap-4">
                        @foreach($products as $product)
                            @include('partials.product-card', ['product' => $product])
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
