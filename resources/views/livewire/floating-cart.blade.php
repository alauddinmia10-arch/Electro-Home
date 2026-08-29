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
<a href="{{ route('cart') }}" id="desktop-floating-cart" class="fixed right-0 top-1/2 -translate-y-1/2 z-40 hidden md:flex flex-col items-center justify-center bg-white w-[130px] rounded-l-xl shadow-[0_4px_15px_rgba(0,0,0,0.1)] hover:shadow-[0_6px_25px_rgba(0,0,0,0.15)] transition-all group overflow-hidden border border-gray-200 border-r-0" x-data="{ floatCount: {{ $count }}, floatSubtotal: {{ $subtotal }} }" @cart-updated-optimistic.window="floatCount += $event.detail.qty_change; floatSubtotal += $event.detail.amount" @cart-updated.window="if($event.detail.subtotal !== undefined) { floatCount = $event.detail.count; floatSubtotal = $event.detail.subtotal; }">
    <div class="relative w-full flex justify-center pt-6 pb-2 bg-white">
        <div class="relative inline-block animate-cart-dance">
            {{-- Custom Cart Icon with Plus (Exact match from Falaq Food) --}}
            <svg viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-12 w-12 text-[#6c757d] group-hover:text-[#1f618d] transition-colors">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 7C12 7.55 11.55 8 11 8C10.45 8 10 7.55 10 7V5H8C7.45 5 7 4.55 7 4C7 3.45 7.45 3 8 3H10V1C10 0.45 10.45 0 11 0C11.55 0 12 0.45 12 1V3H14C14.55 3 15 3.45 15 4C15 4.55 14.55 5 14 5H12V7ZM4.01 19C4.01 17.9 4.9 17 6 17C7.1 17 8 17.9 8 19C8 20.1 7.1 21 6 21C4.9 21 4.01 20.1 4.01 19ZM16 17C14.9 17 14.01 17.9 14.01 19C14.01 20.1 14.9 21 16 21C17.1 21 18 20.1 18 19C18 17.9 17.1 17 16 17ZM14.55 12H7.1L6 14H17C17.55 14 18 14.45 18 15C18 15.55 17.55 16 17 16H6C4.48 16 3.52 14.37 4.25 13.03L5.6 10.59L2 3H1C0.45 3 0 2.55 0 2C0 1.45 0.45 1 1 1H2.64C3.02 1 3.38 1.22 3.54 1.57L7.53 10H14.55L17.94 3.87C18.2 3.39 18.81 3.22 19.29 3.48C19.77 3.75 19.95 4.36 19.68 4.84L16.3 10.97C15.96 11.59 15.3 12 14.55 12Z" fill="currentColor"/>
            </svg>
            
            <span x-show="floatCount > 0" x-text="floatCount" wire:ignore class="absolute text-red-600 font-bold text-center z-10" style="display: none; top: -12px; right: 44px; font-size: 30px; line-height: 1;">
                {{ $count }}
            </span>
        </div>
    </div>
    
    <div class="bg-[#1f618d] w-full text-center py-2.5 pl-2 text-[16px] font-bold text-white transition-colors">
        <span wire:ignore x-text="'৳' + new Intl.NumberFormat('en-US').format(floatSubtotal)">৳{{ number_format($subtotal, 0) }}</span>
    </div>
</a>
