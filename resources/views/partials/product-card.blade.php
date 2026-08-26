@props(['product', 'showBadge' => null, 'view' => 'grid'])

<div class="product-card group relative flex {{ $view === 'list' ? 'flex-row h-auto p-2.5 md:p-4 gap-3 md:gap-6 items-center' : 'flex-col h-full' }} bg-white border border-gray-100 rounded-lg overflow-hidden">
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
    <a href="{{ route('product.show', $product->slug) }}" class="product-image block {{ $view === 'list' ? 'w-24 h-24 md:w-48 md:h-48 shrink-0' : 'aspect-square' }} bg-white relative">
        @if($product->cover_image_url)
            <img src="{{ $product->cover_image_url }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-contain">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-300">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        @endif
    </a>

    {{-- Content --}}
    <div class="{{ $view === 'list' ? 'flex flex-col flex-1 justify-center min-w-0 pr-1' : 'px-2.5 pb-2.5 pt-2 flex flex-col flex-1 border-t border-gray-100' }}">
        <a href="{{ route('product.show', $product->slug) }}" class="text-sm font-semibold text-gray-800 line-clamp-2 mb-1.5 hover:text-[var(--color-trust-blue)] transition-colors flex-1" title="{{ $product->name }}">
            {{ $product->name }}
        </a>
        <div class="{{ $view === 'list' ? 'mt-1.5 md:mt-4 flex flex-col md:flex-row md:items-center justify-between gap-2 md:gap-6' : 'mt-auto pt-2.5 flex flex-col gap-2.5 border-t border-gray-50' }}">
            @if($product->discount_price && $product->discount_price < $product->regular_price)
                <div class="flex {{ $view === 'list' ? 'flex-row items-center gap-2 md:gap-4' : 'justify-between items-start' }}">
                    <div class="flex {{ $view === 'list' ? 'flex-row items-center gap-2 md:gap-3' : 'flex-col leading-tight' }}">
                        <span class="text-[17px] font-bold text-[var(--color-trust-blue)]">৳{{ number_format($product->discount_price, 0) }}</span>
                        <span class="text-xs text-gray-400 line-through mt-0.5">৳{{ number_format($product->regular_price, 0) }}</span>
                    </div>
                    <div class="flex flex-col items-end leading-tight {{ $view === 'list' ? 'bg-green-50 px-2 py-1 rounded' : '' }}">
                        <span class="text-xs font-medium text-[#00a651]">Save</span>
                        <span class="text-xs font-bold text-[#00a651] mt-0.5">৳{{ number_format($product->regular_price - $product->discount_price, 0) }}</span>
                    </div>
                </div>
            @else
                <div class="flex {{ $view === 'list' ? 'flex-row items-center gap-2 md:gap-4' : 'justify-between items-start' }}">
                    <div class="flex {{ $view === 'list' ? 'flex-row items-center gap-2 md:gap-3' : 'flex-col leading-tight' }}">
                        <span class="text-[17px] font-bold text-[var(--color-trust-blue)]">৳{{ number_format($product->regular_price, 0) }}</span>
                        @if($view !== 'list')
                        <span class="text-xs text-transparent mt-0.5">-</span>
                        @endif
                    </div>
                </div>
            @endif
            
            <div class="{{ $view === 'list' ? 'w-full md:w-48 mt-1 md:mt-0' : '' }}">
                <livewire:product-card-add-to-cart 
                    :product="$product" 
                    :button-class="request('cols') == 6 && $view !== 'list' ? 'gap-1 px-1 text-[13px]' : 'gap-2 px-2.5 text-[15px]'" 
                    :svg-class="request('cols') == 6 && $view !== 'list' ? 'w-4 h-4' : 'w-4 h-4'" 
                    wire:key="add-to-cart-btn-{{ $product->id }}" 
                />
            </div>
        </div>
    </div>
</div>
