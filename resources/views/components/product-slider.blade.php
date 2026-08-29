@props(['title', 'icon', 'products', 'viewAllUrl' => '#'])

<div class="md:bg-white md:rounded-lg md:shadow-sm md:border md:border-gray-100 md:px-3 md:py-2 relative" x-data="{
    autoScrollInterval: null,
    observer: null,
    init() {
        this.$nextTick(() => {
            this.setupIntersectionObserver();
        });
    },
    setupIntersectionObserver() {
        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.startAutoScroll();
                } else {
                    this.stopAutoScroll();
                }
            });
        }, { threshold: 0.1 });
        this.observer.observe(this.$el);
    },
    startAutoScroll() {
        if (!this.autoScrollInterval) {
            this.autoScrollInterval = setInterval(() => {
                this.doScrollRight();
            }, 3000);
        }
    },
    stopAutoScroll() {
        if (this.autoScrollInterval) {
            clearInterval(this.autoScrollInterval);
            this.autoScrollInterval = null;
        }
    },
    getJumpDistance() {
        if (!this.$refs.firstOriginal || !this.$refs.firstClone) return 0;
        return this.$refs.firstClone.offsetLeft - this.$refs.firstOriginal.offsetLeft;
    },
    doScrollRight() {
        const slider = this.$refs.slider;
        if (!slider) return;
        
        const jumpDistance = this.getJumpDistance();
        
        if (jumpDistance > 0 && slider.scrollLeft >= jumpDistance) {
            slider.style.scrollBehavior = 'auto';
            slider.scrollLeft -= jumpDistance;
            
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    slider.style.scrollBehavior = 'smooth';
                    slider.scrollBy({ left: 300 });
                });
            });
        } else {
            slider.style.scrollBehavior = 'smooth';
            slider.scrollBy({ left: 300 });
        }
    },
    doScrollLeft() {
        const slider = this.$refs.slider;
        if (!slider) return;
        
        const jumpDistance = this.getJumpDistance();
        
        if (jumpDistance > 0 && slider.scrollLeft <= 0) {
            slider.style.scrollBehavior = 'auto';
            slider.scrollLeft += jumpDistance;
            
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    slider.style.scrollBehavior = 'smooth';
                    slider.scrollBy({ left: -300 });
                });
            });
        } else {
            slider.style.scrollBehavior = 'smooth';
            slider.scrollBy({ left: -300 });
        }
    },
    handleManualScroll() {
        // Prevent manual scrolling from hitting the edges by invisibly resetting
        const slider = this.$refs.slider;
        const jumpDistance = this.getJumpDistance();
        if (jumpDistance > 0) {
            if (slider.scrollLeft >= jumpDistance * 2) {
                slider.style.scrollBehavior = 'auto';
                slider.scrollLeft -= jumpDistance;
            } else if (slider.scrollLeft <= 0) {
                slider.style.scrollBehavior = 'auto';
                slider.scrollLeft += jumpDistance;
            }
        }
    }
}" @mouseenter="stopAutoScroll" @mouseleave="startAutoScroll" @touchstart="stopAutoScroll" @touchend="startAutoScroll">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            {{ $title }} <span>{{ $icon }}</span>
        </h2>
        <a href="{{ $viewAllUrl }}" class="text-xs font-semibold text-gray-600 border border-gray-300 rounded px-3 py-1.5 hover:bg-gray-50 transition-colors">
            View All
        </a>
    </div>

    <div class="relative group">
        {{-- Left Arrow --}}
        <div class="absolute -left-4 md:-left-5 xl:-left-10 top-1/2 -translate-y-1/2 z-50">
            <button @click="doScrollLeft()" 
                    style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                    class="p-0 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>
        </div>

        {{-- Slider Container --}}
        <div x-ref="slider" @scroll.passive="handleManualScroll" class="flex overflow-x-auto snap-x snap-mandatory gap-2 md:gap-2.5 pb-2 scrollbar-hide no-scrollbar">
            {{-- Set 1: Original Products --}}
            @foreach($products as $loopIndex => $product)
                <div {{ $loopIndex === 0 ? 'x-ref=firstOriginal' : '' }} class="shrink-0 snap-start w-[calc((100%-8px)/2)] md:w-[calc((100%-30px)/4)] lg:w-[calc((100%-40px)/5)] h-full">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach

            {{-- Set 2: Cloned Products for Infinite Scroll --}}
            @foreach($products as $loopIndex => $product)
                <div {{ $loopIndex === 0 ? 'x-ref=firstClone' : '' }} class="shrink-0 snap-start w-[calc((100%-8px)/2)] md:w-[calc((100%-30px)/4)] lg:w-[calc((100%-40px)/5)] h-full" aria-hidden="true">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
            
            {{-- Set 3: Extra Clone to buffer against fast manual scrolling --}}
            @foreach($products as $loopIndex => $product)
                <div class="shrink-0 snap-start w-[calc((100%-8px)/2)] md:w-[calc((100%-30px)/4)] lg:w-[calc((100%-40px)/5)] h-full" aria-hidden="true">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>

        {{-- Right Arrow --}}
        <div class="absolute -right-4 md:-right-5 xl:-right-10 top-1/2 -translate-y-1/2 z-50">
            <button @click="doScrollRight()" 
                    style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                    class="p-0 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>
</div>
