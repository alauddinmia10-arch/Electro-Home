<?php

use App\Services\CartService;
use Livewire\Volt\Component;

new class extends Component {
    public int $count = 0;
    public float $subtotal = 0;

    public function mount(CartService $cart)
    {
        $this->updateCart($cart);
    }

    #[\Livewire\Attributes\On('cart-updated')]
    public function updateCart(CartService $cart)
    {
        $this->count = $cart->getCount();
        $this->subtotal = $cart->getSubtotal();
    }
};
?>
<a href="{{ route('cart') }}" class="flex items-center gap-2 p-2 group text-gray-600 hover:text-[var(--color-trust-blue)] transition-colors relative" x-data="{ cartCount: {{ $count }}, cartSubtotal: {{ $subtotal }} }" @cart-updated-optimistic.window="cartCount += $event.detail.qty_change; cartSubtotal += $event.detail.amount" @cart-updated.window="if($event.detail.subtotal !== undefined) { cartCount = $event.detail.count; cartSubtotal = $event.detail.subtotal; }">
    <div class="relative">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
        </svg>
        <span x-show="cartCount > 0" x-text="cartCount" wire:ignore class="absolute -top-1.5 -right-1.5 bg-[var(--color-soft-coral)] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[1.25rem] text-center shadow-sm" style="display: none;">
            {{ $count }}
        </span>
    </div>
    <div class="hidden sm:block text-sm font-semibold">
        <span class="block text-xs text-gray-500 font-normal leading-tight group-hover:text-[var(--color-trust-blue)] transition-colors">My Cart</span>
        <span class="text-price" wire:ignore x-text="'৳' + new Intl.NumberFormat('en-US').format(cartSubtotal)">৳{{ number_format($subtotal, 0) }}</span>
    </div>
</a>
