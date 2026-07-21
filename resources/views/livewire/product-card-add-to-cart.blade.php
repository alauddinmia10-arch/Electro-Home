<?php

use App\Services\CartService;
use Livewire\Volt\Component;
use App\Models\Product;

new class extends Component {
    public int $productId;
    public bool $outOfStock = false;
    public string $buttonClass = '';
    public string $svgClass = '';
    public float $price = 0;

    public function mount(Product $product)
    {
        $this->productId = $product->id;
        $this->outOfStock = $product->stock_quantity !== null && $product->stock_quantity <= 0;
        $this->price = $product->discount_price ?? $product->regular_price;
    }

    public function addToCart(CartService $cart)
    {
        if ($this->outOfStock) return;

        $cart->add($this->productId, 1);
        $this->dispatch('cart-updated', subtotal: $cart->getSubtotal(), count: $cart->getCount());
        
        // Show a success message in UI or redirect
        $this->dispatch('toast', message: 'Product added to cart!', type: 'success');
    }
};
?>

<div x-data="{ adding: false }">
    <button type="button" @click="$dispatch('cart-updated-optimistic', { amount: {{ $price }}, qty_change: 1 }); $wire.addToCart(); adding = true; setTimeout(() => adding = false, 800)" x-bind:disabled="adding" x-bind:class="adding ? 'bg-[#00a651] hover:bg-[#00a651]' : 'bg-[#0b5c9a] hover:bg-[#094d82]'" class="w-full flex items-center justify-center {{ $buttonClass }} text-white font-semibold leading-none py-2 rounded transition-colors whitespace-nowrap {{ $outOfStock ? 'opacity-50 cursor-not-allowed bg-gray-400 hover:bg-gray-400' : '' }}" {{ $outOfStock ? 'disabled' : '' }}>
        <svg x-show="!adding" class="{{ $svgClass }} shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
        <svg x-show="adding" style="display: none;" class="{{ $svgClass }} shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
        <span x-show="!adding" class="truncate">Add to Order</span>
        <span x-show="adding" style="display: none;" class="truncate">Added!</span>
    </button>
</div>
