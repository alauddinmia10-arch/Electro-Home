@props(['title', 'icon', 'products', 'viewAllUrl' => '#'])

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 relative" x-data="{
    scrollLeft() {
        $refs.slider.scrollBy({ left: -300, behavior: 'smooth' });
    },
    scrollRight() {
        $refs.slider.scrollBy({ left: 300, behavior: 'smooth' });
    }
}">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            {{ $title }} <span>{{ $icon }}</span>
        </h2>
        <a href="{{ $viewAllUrl }}" class="text-xs font-semibold text-gray-600 border border-gray-300 rounded px-3 py-1.5 hover:bg-gray-50 transition-colors">
            View All
        </a>
    </div>

    <div class="relative group">
        {{-- Left Arrow --}}
        <button @click="scrollLeft" class="absolute left-0 top-1/2 -translate-y-1/2 -ml-3 z-10 w-8 h-8 flex items-center justify-center bg-white rounded shadow border border-gray-100 text-gray-400 hover:text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>

        {{-- Slider Container --}}
        <div x-ref="slider" class="flex overflow-x-auto snap-x snap-mandatory gap-3 pb-2 scrollbar-hide no-scrollbar" style="scroll-behavior: smooth;">
            @foreach($products as $product)
                <div class="shrink-0 snap-start w-36 md:w-44 lg:w-48">
                    @include('partials.product-card-minimal', ['product' => $product])
                </div>
            @endforeach
        </div>

        {{-- Right Arrow --}}
        <button @click="scrollRight" class="absolute right-0 top-1/2 -translate-y-1/2 -mr-3 z-10 w-8 h-8 flex items-center justify-center bg-white rounded shadow border border-gray-100 text-gray-400 hover:text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</div>
