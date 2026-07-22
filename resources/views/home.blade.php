<x-layouts.app>
    <div class="flex flex-col gap-4 pt-4 pb-8">
    {{-- Hero Banners --}}
    <section class="max-w-[1440px] w-full mx-auto px-4 xl:px-[70px]">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-auto md:h-96">
            {{-- Main Slider --}}
            <div class="md:col-span-3 rounded-xl overflow-hidden relative shadow-sm h-64 md:h-full bg-gray-900 group" x-data="{ activeSlide: 0, slides: [0, 1, 2] }" x-init="setInterval(() => { activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1 }, 5000)">
                @forelse($banners as $index => $banner)
                    <div x-show="activeSlide === {{ $index }}" x-transition.opacity.duration.500ms class="absolute inset-0">
                        <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>
                @empty
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-emerald-500 flex flex-col items-center justify-center text-white p-8">
                        <h1 class="text-3xl md:text-5xl font-bold mb-4 font-bangla text-center">আপনার স্বপ্নের প্রজেক্ট<br>শুরু করুন আজই!</h1>
                        <p class="text-lg opacity-90 mb-6">Electrohome.bd-এ পাচ্ছেন সেরা মানের ইলেকট্রনিক্স কম্পোনেন্ট</p>
                        <a href="{{ route('shop') }}" class="bg-white text-blue-600 px-6 py-3 rounded-full font-bold shadow-lg hover:scale-105 transition-transform">
                            Shop Now
                        </a>
                    </div>
                @endforelse
                
                {{-- Indicators --}}
                <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 z-10">
                    <template x-for="slide in slides" :key="slide">
                        <button @click="activeSlide = slide" class="w-2.5 h-2.5 rounded-full transition-all" :class="activeSlide === slide ? 'bg-white w-6' : 'bg-white/50'"></button>
                    </template>
                </div>
            </div>

            {{-- Right Side Banners --}}
            <div class="hidden md:flex flex-col gap-4 h-full">
                <div class="flex-1 bg-gradient-to-br from-orange-400 to-red-500 rounded-xl p-6 text-white shadow-sm flex flex-col justify-center relative overflow-hidden group">
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-1">Flash Sale</h3>
                        <p class="text-sm opacity-90 mb-4">Up to 50% Off</p>
                        <a href="#flash-sales" class="inline-flex items-center gap-1 text-sm font-semibold hover:gap-2 transition-all">Shop Deals &rarr;</a>
                    </div>
                    <svg class="absolute -right-4 -bottom-4 w-32 h-32 opacity-20 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div class="flex-1 bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl p-6 text-white shadow-sm flex flex-col justify-center relative overflow-hidden group">
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-1">New Sensors</h3>
                        <p class="text-sm opacity-90 mb-4">IoT & Robotics</p>
                        <a href="{{ route('shop') }}" class="inline-flex items-center gap-1 text-sm font-semibold hover:gap-2 transition-all">Explore &rarr;</a>
                    </div>
                    <svg class="absolute -right-4 -bottom-4 w-32 h-32 opacity-10 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                </div>
            </div>
        </div>
    </section>

    {{-- Features / Trust Badges --}}
    <section class="max-w-[1440px] w-full mx-auto px-4 xl:px-[70px]">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex flex-wrap gap-4 md:gap-0 justify-between items-center text-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-50 text-[var(--color-trust-blue)] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Fast Delivery</h4>
                    <p class="text-gray-500 text-xs">All over Bangladesh</p>
                </div>
            </div>
            <div class="hidden md:block w-px h-10 bg-gray-100"></div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-50 text-[var(--color-sea-green)] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Quality Products</h4>
                    <p class="text-gray-500 text-xs">Verified by experts</p>
                </div>
            </div>
            <div class="hidden md:block w-px h-10 bg-gray-100"></div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-orange-50 text-[var(--color-warm-orange)] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Secure Checkout</h4>
                    <p class="text-gray-500 text-xs">SSLCommerz & COD</p>
                </div>
            </div>
            <div class="hidden md:block w-px h-10 bg-gray-100"></div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-purple-50 text-[var(--color-soft-purple)] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Support 24/7</h4>
                    <p class="text-gray-500 text-xs">Always here for you</p>
                </div>
            </div>
        </div>
    </section>



    {{-- Flash Sale --}}
    @if($flashSaleProducts->count() > 0)
    <section id="flash-sales" class="max-w-[1440px] w-full mx-auto px-4 xl:px-[70px]">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-red-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-50 rounded-full blur-3xl -z-10"></div>
            
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 border-b border-red-100 pb-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-2xl font-bold flex items-center gap-2">
                        <span class="text-[var(--color-soft-coral)]">⚡ Flash Sale</span>
                    </h2>
                    <div class="hidden md:block">
                        <livewire:flash-sale-timer :endTime="$flashSaleProducts->first()->flash_sale_ends_at->toIso8601String()" />
                    </div>
                </div>
                <a href="{{ route('shop', ['flash_sale' => 1]) }}" class="text-red-600 hover:underline text-sm font-semibold">See All Deals &rarr;</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($flashSaleProducts as $product)
                    @include('partials.product-card', ['product' => $product, 'showBadge' => 'flash'])
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Top Selling --}}
    @if($bestSellers->count() > 0)
    <section class="max-w-[1440px] w-full mx-auto px-4 xl:px-[70px]">
        <x-product-slider 
            title="Top Selling" 
            icon="🏆" 
            :products="$bestSellers" 
            viewAllUrl="{{ route('shop', ['sort' => 'popular']) }}" 
        />
    </section>
    @endif

    {{-- New Arrivals --}}
    @if($newArrivals->count() > 0)
    <section class="max-w-[1440px] w-full mx-auto px-4 xl:px-[70px]">
        <x-product-slider 
            title="New Arrivals" 
            icon="🆕" 
            :products="$newArrivals" 
            viewAllUrl="{{ route('shop') }}" 
        />
    </section>
    @endif

    {{-- Trending Now --}}
    @if($featuredProducts->count() > 0)
    <section class="max-w-[1440px] w-full mx-auto px-4 xl:px-[70px]">
        <x-product-slider 
            title="Trending Now" 
            icon="📈" 
            :products="$featuredProducts" 
            viewAllUrl="{{ route('shop', ['featured' => 1]) }}" 
        />
    </section>
    @endif

    {{-- Browse Categories --}}
    <section class="max-w-[1440px] w-full mx-auto px-4 xl:px-[70px]">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Top Categories</h2>
            <a href="{{ route('shop') }}" class="text-[var(--color-trust-blue)] hover:underline text-sm font-semibold">View All</a>
        </div>
        
        <div class="grid grid-cols-3 md:grid-cols-6 gap-3 md:gap-4">
            @foreach($categories as $category)
                <a href="{{ route('shop', ['category' => $category->slug]) }}" class="bg-white rounded-xl p-4 text-center hover:shadow-md transition-shadow border border-gray-100 group">
                    <div class="text-3xl mb-2 transform group-hover:scale-110 transition-transform">{{ $category->icon }}</div>
                    <h3 class="text-xs md:text-sm font-semibold text-gray-800">{{ $category->name }}</h3>
                </a>
            @endforeach
        </div>
    </section>

    </div>
</x-layouts.app>
