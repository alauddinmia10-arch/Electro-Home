@props(['title', 'icon', 'products', 'viewAllUrl' => '#'])

<div class="md:bg-white md:rounded-lg md:shadow-sm md:border md:border-gray-100 md:px-3 md:py-2 relative" x-data="{
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
    scrollLeft() {
        this.$refs.slider.scrollBy({ left: -300, behavior: 'smooth' });
    },
    scrollRight() {
        this.$refs.slider.scrollBy({ left: 300, behavior: 'smooth' });
    }
}">
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
        <div class="absolute left-0 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="showLeft">
            <button @click="scrollLeft" 
                    style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                    class="p-0 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>
        </div>

        {{-- Slider Container --}}
        <div x-ref="slider" @scroll="checkScroll" class="flex overflow-x-auto snap-x snap-mandatory gap-2 md:gap-2.5 pb-2 scrollbar-hide no-scrollbar" style="scroll-behavior: smooth;">
            @foreach($products as $product)
                <div class="shrink-0 snap-start w-[calc((100%-8px)/2)] md:w-[calc((100%-30px)/4)] lg:w-[calc((100%-40px)/5)] h-full">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>

        {{-- Right Arrow --}}
        <div class="absolute right-0 top-1/2 -translate-y-1/2 z-50" x-cloak x-show="showRight">
            <button @click="scrollRight" 
                    style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                    class="p-0 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>
</div>
