@props(['product', 'showBadge' => null])

<div class="product-card group relative flex flex-col h-full bg-white border border-gray-100">
    {{-- Badges --}}
    <div class="absolute top-2 left-2 z-10 flex flex-col gap-1">
        @if($product->status !== 'in_stock' || $product->stock_quantity <= 0)
            <span class="badge-out">Out of Stock</span>
        @elseif($showBadge === 'flash' || $product->is_flash_sale)
            <span class="badge-flash">Flash Deal</span>
        @elseif($showBadge === 'new')
            <span class="badge-new">New</span>
        @endif

        @if($product->discount_price && $product->discount_price < $product->regular_price)
            @php
                $percentage = round((($product->regular_price - $product->discount_price) / $product->regular_price) * 100);
            @endphp
            <span class="badge-sale">-{{ $percentage }}%</span>
        @endif
    </div>

    <livewire:wishlist-button :product-id="$product->id" wire:key="wishlist-btn-{{ $product->id }}" />

    {{-- Image --}}
    <a href="{{ route('product.show', $product->slug) }}" class="product-image block aspect-square bg-gray-50 relative p-4">
        @if($product->cover_image)
            <img src="{{ Storage::url($product->cover_image) }}" alt="{{ $product->name }}" loading="lazy">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-300">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        @endif
    </a>

    {{-- Content --}}
    <div class="p-4 flex flex-col flex-1">
        <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="text-xs text-gray-500 mb-1 hover:text-[var(--color-trust-blue)] transition-colors">
            {{ $product->category->name }}
        </a>
        <a href="{{ route('product.show', $product->slug) }}" class="text-sm font-semibold text-gray-800 line-clamp-2 mb-2 hover:text-[var(--color-trust-blue)] transition-colors flex-1" title="{{ $product->name }}">
            {{ $product->name }}
        </a>
        
        <div class="flex items-end justify-between mt-auto pt-2 border-t border-gray-50">
            <div>
                @if($product->discount_price && $product->discount_price < $product->regular_price)
                    <div class="text-price-old">৳{{ number_format($product->regular_price, 0) }}</div>
                    <div class="text-price text-lg">৳{{ number_format($product->discount_price, 0) }}</div>
                @else
                    <div class="text-price text-lg">৳{{ number_format($product->regular_price, 0) }}</div>
                @endif
            </div>
            
            <a href="{{ route('product.show', $product->slug) }}" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-[var(--color-sea-green)] hover:text-white transition-colors border border-gray-200 hover:border-transparent">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </a>
        </div>
    </div>
</div>
