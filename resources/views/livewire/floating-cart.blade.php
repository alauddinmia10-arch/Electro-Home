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
<a href="{{ route('cart') }}" class="fixed right-0 top-1/2 -translate-y-1/2 z-40 hidden md:flex flex-col items-center justify-center bg-gray-900 text-white w-16 py-3 rounded-l-lg shadow-xl hover:bg-gray-800 transition-colors group border-y border-l border-gray-700">
    <div class="relative mb-1">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
        </svg>
        @if($count > 0)
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[1.25rem] text-center">
                {{ $count }}
            </span>
        @endif
    </div>
    <div class="text-[10px] font-semibold text-gray-300 uppercase tracking-wider mb-1">Cart</div>
    <div class="bg-gray-800 w-full text-center py-1 text-xs font-bold text-yellow-400 group-hover:bg-gray-700 transition-colors">
        ৳{{ number_format($subtotal, 0) }}
    </div>
</a>
