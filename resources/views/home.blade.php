<x-layouts.app>
    <div class="flex flex-col gap-6 md:gap-8 pt-2 md:pt-4 pb-12 md:pb-20">
    {{-- Hero Banners --}}
    <section class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-auto md:h-[420px]">
            {{-- Main Slider --}}
            <div class="md:col-span-3 rounded-lg overflow-hidden relative shadow-sm aspect-video md:aspect-auto md:h-full bg-gray-900 group" x-data="{ activeSlide: 0, slides: [0, 1, 2] }" x-init="setInterval(() => { activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1 }, 5000)">
                <div x-show="activeSlide === 0" x-transition.opacity.duration.500ms class="absolute inset-0">
                    <img src="{{ asset('images/sliders/slide1.png') }}" alt="Hybrid Solar Inverter" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 flex flex-col items-center pt-6 pb-5 md:pt-10 md:pb-10 px-4 md:px-8 text-center text-white">
                        <div class="flex-1 flex flex-col justify-center items-center">
                            <h1 class="text-2xl md:text-5xl font-bold mb-2 md:mb-4 font-bangla drop-shadow-lg">আপনার স্বপ্নের প্রজেক্ট শুরু করুন</h1>
                            <p class="text-xs md:text-lg opacity-90 drop-shadow-md">সেরা সোলার ও ইনভার্টার সলিউশন</p>
                        </div>
                        <a href="{{ route('shop') }}" class="shrink-0 bg-blue-600 text-white px-5 py-2 text-sm md:text-base md:px-8 md:py-3 rounded-full font-bold shadow-lg hover:bg-blue-700 hover:scale-105 transition-all mt-3 md:mt-6">Shop Now</a>
                    </div>
                </div>

                <div x-show="activeSlide === 1" x-transition.opacity.duration.500ms class="absolute inset-0">
                    <img src="{{ asset('images/sliders/slide2.png') }}" alt="Lithium Phosphate Battery" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 flex flex-col items-center pt-6 pb-5 md:pt-10 md:pb-10 px-4 md:px-8 text-center text-white">
                        <div class="flex-1 flex flex-col justify-center items-center">
                            <h1 class="text-2xl md:text-5xl font-bold mb-2 md:mb-4 font-bangla drop-shadow-lg">দীর্ঘস্থায়ী পাওয়ার সলিউশন</h1>
                            <p class="text-xs md:text-lg opacity-90 drop-shadow-md">সেরা মানের LiFePO4 ব্যাটারি</p>
                        </div>
                        <a href="{{ route('shop') }}" class="shrink-0 bg-emerald-600 text-white px-5 py-2 text-sm md:text-base md:px-8 md:py-3 rounded-full font-bold shadow-lg hover:bg-emerald-700 hover:scale-105 transition-all mt-3 md:mt-6">Explore Batteries</a>
                    </div>
                </div>

                <div x-show="activeSlide === 2" x-transition.opacity.duration.500ms class="absolute inset-0">
                    <img src="{{ asset('images/sliders/slide3.png') }}" alt="Electronic Components" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 flex flex-col items-center pt-6 pb-5 md:pt-10 md:pb-10 px-4 md:px-8 text-center text-white">
                        <div class="flex-1 flex flex-col justify-center items-center">
                            <h1 class="text-2xl md:text-5xl font-bold mb-2 md:mb-4 font-bangla drop-shadow-lg">ইলেকট্রনিক্স কম্পোনেন্ট</h1>
                            <p class="text-xs md:text-lg opacity-90 drop-shadow-md">সার্কিট, সেন্সর ও রোবোটিক্স</p>
                        </div>
                        <a href="{{ route('shop') }}" class="shrink-0 bg-[var(--color-trust-blue)] text-white px-5 py-2 text-sm md:text-base md:px-8 md:py-3 rounded-full font-bold shadow-lg hover:bg-blue-500 hover:scale-105 transition-all mt-3 md:mt-6">View Components</a>
                    </div>
                </div>

                {{-- Indicators --}}
                <div class="absolute bottom-1 md:bottom-4 left-0 right-0 flex justify-center gap-2 z-10">
                    <template x-for="slide in slides" :key="slide">
                        <button @click="activeSlide = slide" class="w-2.5 h-2.5 rounded-full transition-all" :class="activeSlide === slide ? 'bg-white w-6' : 'bg-white/50'"></button>
                    </template>
                </div>
            </div>

            {{-- Right Side Banners --}}
            <div class="hidden md:flex flex-col gap-4 h-full">
                <div class="flex-1 bg-gray-900 rounded-lg p-6 text-white shadow-sm flex flex-col justify-center relative overflow-hidden group"
                     @if(isset($flashSaleProducts) && $flashSaleProducts->count() > 0)
                     x-data="{ activeIndex: 0, total: {{ min(5, $flashSaleProducts->count()) }} }"
                     x-init="setInterval(() => { activeIndex = (activeIndex + 1) % total }, 3000)"
                     @endif>
                     
                    {{-- Background Sliding Images --}}
                    @if(isset($flashSaleProducts) && $flashSaleProducts->count() > 0)
                        @foreach($flashSaleProducts->take(5) as $index => $product)
                            <div x-show="activeIndex === {{ $index }}" 
                                 x-transition.opacity.duration.1000ms
                                 class="absolute inset-0 w-full h-full z-0">
                                <img src="{{ $product->cover_image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors"></div>
                            </div>
                        @endforeach
                    @endif

                    {{-- Original Text Content --}}
                    @php
                        $maxDiscount = 0;
                        if(isset($flashSaleProducts) && $flashSaleProducts->count() > 0) {
                            foreach($flashSaleProducts as $p) {
                                if($p->regular_price > 0 && $p->discount_price > 0 && $p->discount_price < $p->regular_price) {
                                    $discount = round((($p->regular_price - $p->discount_price) / $p->regular_price) * 100);
                                    if($discount > $maxDiscount) {
                                        $maxDiscount = $discount;
                                    }
                                }
                            }
                        }
                    @endphp
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-1">Flash Sale</h3>
                        @if($maxDiscount > 0)
                            <p class="text-sm opacity-90 mb-4">Up to {{ $maxDiscount }}% Off</p>
                        @else
                            <p class="text-sm opacity-90 mb-4">Hot Deals Inside</p>
                        @endif
                        <a href="#flash-sales" class="inline-flex items-center gap-1 text-sm font-semibold hover:gap-2 transition-all">Shop Deals &rarr;</a>
                    </div>
                    <svg class="absolute -right-4 -bottom-4 w-32 h-32 opacity-20 group-hover:scale-110 transition-transform z-0" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div class="flex-1 bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg p-6 text-white shadow-sm flex flex-col justify-center relative overflow-hidden group">
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



    {{-- Flash Sale --}}
    @if($flashSaleProducts->count() > 0)
    <section id="flash-sales" class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
        <div class="md:bg-white md:rounded-lg md:p-3 md:shadow-sm md:border md:border-red-100 relative overflow-hidden"
             x-data="{
                 showLeft: false,
                 showRight: true,
                 init() {
                     this.$nextTick(() => this.checkScroll());
                     window.addEventListener('resize', () => this.checkScroll());
                 },
                 checkScroll() {
                     const slider = this.$refs.slider;
                     if (!slider) return;
                     this.showLeft = slider.scrollLeft > 0;
                     this.showRight = Math.ceil(slider.scrollLeft + slider.clientWidth) < slider.scrollWidth;
                 },
                 scrollLeft() { this.$refs.slider.scrollBy({ left: -300, behavior: 'smooth' }); },
                 scrollRight() { this.$refs.slider.scrollBy({ left: 300, behavior: 'smooth' }); }
             }">
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-50 rounded-full blur-3xl -z-10"></div>
            
            <div class="flex items-center justify-between mb-3">
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

            <div class="relative group">
                {{-- Left Arrow --}}
                <div class="absolute -left-5 md:-left-8 xl:-left-12 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="showLeft">
                    <button @click="scrollLeft" 
                            style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                            class="p-1 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                        <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                </div>

                {{-- Slider Container --}}
                <div x-ref="slider" @scroll="checkScroll" class="flex overflow-x-auto snap-x snap-mandatory gap-2 md:gap-2.5 scrollbar-hide no-scrollbar" style="scroll-behavior: smooth;">
                    @foreach($flashSaleProducts as $product)
                        <div class="shrink-0 snap-start w-[calc((100%-8px)/2)] md:w-[calc((100%-30px)/4)] lg:w-[calc((100%-40px)/5)] h-full">
                            @include('partials.product-card', ['product' => $product, 'showBadge' => 'flash'])
                        </div>
                    @endforeach
                </div>

                {{-- Right Arrow --}}
                <div class="absolute -right-3 md:-right-4 xl:-right-12 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="showRight">
                    <button @click="scrollRight" 
                            style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                            class="p-1 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                        <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Top Selling --}}
    @if($bestSellers->count() > 0)
    <section class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
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
    <section class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
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
    <section class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
        <x-product-slider 
            title="Trending Now" 
            icon="📈" 
            :products="$featuredProducts" 
            viewAllUrl="{{ route('shop', ['featured' => 1]) }}" 
        />
    </section>
    @endif

    {{-- Top Brands --}}
    @if(isset($brands) && $brands->count() > 0)
    <style>
        @keyframes float-pulse {
            0%, 100% { opacity: 0.5; transform: scale(0.9); }
            50% { opacity: 1; transform: scale(1.15); box-shadow: 0 0 15px rgba(0,0,0,0.2); }
        }
        @keyframes float-pulse-icon {
            0%, 100% { opacity: 0.6; transform: scale(0.9); }
            50% { opacity: 1; transform: scale(1.2); }
        }
    </style>
    {{-- Top Brands (Mobile View) --}}
    <section class="max-w-[1600px] w-full mx-auto px-3 block md:hidden"
             x-data="{
                activeSlide: 0,
                totalSlides: {{ ceil($brands->count() / 9) }},
                touchStartX: 0,
                touchEndX: 0,
                next() { if(this.activeSlide < this.totalSlides - 1) this.activeSlide++; },
                prev() { if(this.activeSlide > 0) this.activeSlide--; },
                handleSwipe() {
                    let swipeDistance = this.touchStartX - this.touchEndX;
                    if (swipeDistance > 40) {
                        this.next();
                    } else if (swipeDistance < -40) {
                        this.prev();
                    }
                }
             }">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-bold text-gray-900">Top Brands</h2>
        </div>
        
        <div class="relative"
             @touchstart="touchStartX = $event.touches[0].clientX"
             @touchend="touchEndX = $event.changedTouches[0].clientX; handleSwipe()">
            {{-- Prev Button --}}
            <div class="absolute -left-4 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="totalSlides > 1 && activeSlide > 0">
                <button @click="prev" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-0 flex items-center justify-center focus:outline-none text-gray-700 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
            </div>

            {{-- Slider Container --}}
            <div class="overflow-hidden">
                <div class="transition-transform duration-500 ease-in-out flex" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                @foreach($brands->chunk(9) as $chunk)
                    <div class="w-full shrink-0">
                        <div class="grid grid-cols-3 gap-3 px-1 pb-1">
                            @foreach($chunk as $brand)
                                <a href="{{ route('shop', ['brand' => $brand->slug]) }}" 
                                   class="bg-white rounded-xl border border-gray-100 shadow-sm transition-all p-2 flex items-center justify-center aspect-square group">
                                    @if($brand->logo)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($brand->logo) }}" alt="{{ $brand->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform">
                                    @else
                                        <span class="font-bold text-gray-700 text-xs text-center uppercase tracking-wide">{{ $brand->name }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            </div>

            {{-- Next Button --}}
            <div class="absolute -right-4 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="totalSlides > 1 && activeSlide < totalSlides - 1">
                <button @click="next" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-0 flex items-center justify-center focus:outline-none text-gray-700 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </section>

    {{-- Top Brands (Desktop View) --}}
    <section class="max-w-[1600px] w-full mx-auto px-3 xl:px-[70px] hidden md:block"
             x-data="{
                activeSlide: 0,
                totalSlides: {{ ceil($brands->count() / 12) }},
                next() { if(this.activeSlide < this.totalSlides - 1) this.activeSlide++; },
                prev() { if(this.activeSlide > 0) this.activeSlide--; }
             }">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Top Brands</h2>
        </div>
        
        <div class="relative overflow-hidden">
            {{-- Prev Button --}}
            <div class="absolute -left-4 md:-left-8 xl:-left-12 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="totalSlides > 1 && activeSlide > 0">
                <button @click="prev" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-1 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
            </div>

            {{-- Slider Container --}}
            <div class="transition-transform duration-500 ease-in-out flex" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                @foreach($brands->chunk(12) as $chunk)
                    <div class="w-full shrink-0">
                        <div class="grid grid-cols-6 gap-4 px-1 pb-1">
                            @foreach($chunk as $brand)
                                <a href="{{ route('shop', ['brand' => $brand->slug]) }}" 
                                   class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all p-3 flex items-center justify-center aspect-square group">
                                    @if($brand->logo)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($brand->logo) }}" alt="{{ $brand->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform">
                                    @else
                                        <span class="font-bold text-gray-700 text-sm group-hover:text-[var(--color-trust-blue)] transition-colors text-center uppercase tracking-wide">{{ $brand->name }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Next Button --}}
            <div class="absolute -right-5 md:-right-8 xl:-right-12 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="totalSlides > 1 && activeSlide < totalSlides - 1">
                <button @click="next" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-0 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </section>
    @endif

    {{-- Browse Categories --}}
    {{-- Browse Categories (Mobile View) --}}
    <section class="max-w-[1600px] w-full mx-auto px-3 block md:hidden"
             x-data="{
                activeSlide: 0,
                totalSlides: {{ ceil($categories->count() / 9) }},
                touchStartX: 0,
                touchEndX: 0,
                next() { if(this.activeSlide < this.totalSlides - 1) this.activeSlide++; },
                prev() { if(this.activeSlide > 0) this.activeSlide--; },
                handleSwipe() {
                    let swipeDistance = this.touchStartX - this.touchEndX;
                    if (swipeDistance > 40) {
                        this.next();
                    } else if (swipeDistance < -40) {
                        this.prev();
                    }
                }
             }">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-bold text-gray-900">Top Categories</h2>
            <a href="{{ route('shop') }}" class="text-[var(--color-trust-blue)] text-sm font-semibold">View All</a>
        </div>
        
        <div class="relative"
             @touchstart="touchStartX = $event.touches[0].clientX"
             @touchend="touchEndX = $event.changedTouches[0].clientX; handleSwipe()">
             
            {{-- Prev Button --}}
            <div class="absolute -left-5 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="totalSlides > 1 && activeSlide > 0">
                <button @click="prev" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-0 flex items-center justify-center focus:outline-none text-gray-700 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
            </div>

            {{-- Slider Container --}}
            <div class="overflow-hidden">
                <div class="transition-transform duration-500 ease-in-out flex" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                @foreach($categories->chunk(9) as $chunk)
                    <div class="w-full shrink-0">
                        <div class="grid grid-cols-3 gap-3 px-1 pb-1">
                            @foreach($chunk as $category)
                                <a href="{{ route('shop', ['category' => $category->slug]) }}" 
                                   class="bg-white rounded-xl shadow-sm transition-all border border-gray-100 p-2 text-center group flex flex-col items-center justify-center aspect-square">
                                    <div class="text-3xl mb-1 transform group-hover:scale-110 transition-transform">{{ $category->icon }}</div>
                                    <h3 class="text-xs font-semibold text-gray-800 leading-tight">{{ $category->name }}</h3>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            </div>

            {{-- Next Button --}}
            <div class="absolute -right-5 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="totalSlides > 1 && activeSlide < totalSlides - 1">
                <button @click="next" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-0 flex items-center justify-center focus:outline-none text-gray-700 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </section>

    {{-- Browse Categories (Desktop View) --}}
    <section class="max-w-[1600px] w-full mx-auto px-3 xl:px-[70px] hidden md:block"
             x-data="{
                activeSlide: 0,
                totalSlides: {{ ceil($categories->count() / 18) }},
                next() { if(this.activeSlide < this.totalSlides - 1) this.activeSlide++; },
                prev() { if(this.activeSlide > 0) this.activeSlide--; }
             }">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Top Categories</h2>
            <a href="{{ route('shop') }}" class="text-[var(--color-trust-blue)] hover:underline text-sm font-semibold">View All</a>
        </div>
        
        <div class="relative">
             
            {{-- Prev Button --}}
            <div class="absolute -left-5 md:-left-8 xl:-left-12 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="totalSlides > 1 && activeSlide > 0">
                <button @click="prev" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-0 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
            </div>

            {{-- Slider Container --}}
            <div class="overflow-hidden">
                <div class="transition-transform duration-500 ease-in-out flex" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                @foreach($categories->chunk(18) as $chunk)
                    <div class="w-full shrink-0">
                        <div class="grid grid-cols-9 gap-4 px-1 pb-1">
                            @foreach($chunk as $category)
                                <a href="{{ route('shop', ['category' => $category->slug]) }}" 
                                   class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all border border-gray-100 p-2 md:p-3 text-center group flex flex-col items-center justify-center aspect-square">
                                    <div class="text-2xl md:text-3xl mb-1 md:mb-2 transform group-hover:scale-110 transition-transform">{{ $category->icon }}</div>
                                    <h3 class="text-xs font-semibold text-gray-800 leading-tight line-clamp-2">{{ $category->name }}</h3>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            </div>

            {{-- Next Button --}}
            <div class="absolute -right-5 md:-right-8 xl:-right-12 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="totalSlides > 1 && activeSlide < totalSlides - 1">
                <button @click="next" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-0 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </section>



    </div>
</x-layouts.app>
