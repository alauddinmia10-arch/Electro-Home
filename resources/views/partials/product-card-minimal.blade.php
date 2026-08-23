@props(['product'])

<div class="flex flex-col h-full bg-white border border-gray-100 rounded hover:shadow-md transition-shadow relative overflow-hidden group">
    {{-- Image --}}
    <a href="{{ route('product.show', $product->slug) }}" class="block aspect-[4/3] bg-white relative p-4 border-b border-gray-50 flex items-center justify-center">
        @if($product->cover_image_url)
            <img src="{{ $product->cover_image_url }}" alt="{{ $product->name }}" loading="lazy" class="max-w-full max-h-full object-contain transform group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        @endif
    </a>

    {{-- Content --}}
    <div class="p-3 text-center flex flex-col flex-1">
        <a href="{{ route('product.show', $product->slug) }}" class="text-[13px] leading-tight font-medium text-gray-800 line-clamp-2 mb-2 hover:text-blue-600 transition-colors flex-1" title="{{ $product->name }}">
            {{ $product->name }}
        </a>
        
        <div class="mt-auto pt-1">
            @if($product->discount_price && $product->discount_price < $product->regular_price)
                <div class="text-[13px] font-semibold text-blue-600">৳ {{ number_format($product->discount_price, 2) }}</div>
            @else
                <div class="text-[13px] font-semibold text-blue-600">৳ {{ number_format($product->regular_price, 2) }}</div>
            @endif
        </div>
    </div>
</div>
