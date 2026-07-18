<?php

use App\Services\CartService;
use Livewire\Volt\Component;

new class extends Component {
    public int $productId;
    public int $quantity = 1;
    public int $stockQuantity = 0;
    public bool $outOfStock = false;

    public function mount(int $productId, int $stockQuantity)
    {
        $this->productId = $productId;
        $this->stockQuantity = $stockQuantity;
        $this->outOfStock = $stockQuantity <= 0;
    }

    public function increment()
    {
        if ($this->quantity < $this->stockQuantity) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart(CartService $cart)
    {
        if ($this->outOfStock) return;

        $cart->add($this->productId, $this->quantity);
        $this->dispatch('cart-updated');
        
        session()->flash('success', 'Product added to cart successfully!');
    }
    
    public function buyNow(CartService $cart)
    {
        if ($this->outOfStock) return;

        $cart->add($this->productId, $this->quantity);
        $this->dispatch('cart-updated');
        
        return redirect()->route('checkout');
    }
};
?>
<div class="space-y-4">
    @if($outOfStock)
        <div class="p-4 bg-red-50 text-red-700 rounded-lg text-sm font-semibold text-center border border-red-200">
            Out of Stock
        </div>
        <button class="btn btn-neutral w-full">Request Restock</button>
    @else
        <div class="flex flex-col sm:flex-row gap-6 mt-5">
            <!-- Left Column: Quantity & Wishlist -->
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <div class="flex items-center border border-gray-200 rounded-lg bg-white overflow-hidden w-32 h-11 shrink-0" x-data="{ 
                        qty: @entangle('quantity'), 
                        stock: {{ $stockQuantity }}
                    }">
                        <button @click="if(qty > 1) qty--;" class="px-3 py-2 text-gray-600 hover:bg-gray-50 transition-colors h-full flex items-center justify-center" :disabled="qty <= 1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                        </button>
                        <div class="flex-1 text-center font-semibold text-gray-800 border-x border-gray-200 py-2 h-full flex items-center justify-center" x-text="qty">
                            {{ $quantity }}
                        </div>
                        <button @click="if(qty < stock) qty++;" class="px-3 py-2 text-gray-600 hover:bg-gray-50 transition-colors h-full flex items-center justify-center" :disabled="qty >= stock">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </button>
                    </div>
                    <span class="text-xs text-gray-500 whitespace-nowrap hidden">Only {{ $stockQuantity }} left</span>
                </div>
                
                <div class="flex items-center h-11">
                    <button wire:click="toggleWishlist" class="flex items-center gap-2 text-gray-700 hover:text-red-500 font-medium transition-colors whitespace-nowrap">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        <span>Add to Wishlist</span>
                    </button>
                </div>
            </div>

            <!-- Right Column: Buy Now & Add to Cart -->
            <div class="premium-actions-wrapper">
                <!-- Premium Buy Now Button -->
                <button wire:click="buyNow" class="premium-btn btn-emerald">
                    <span class="premium-shine"></span>
                    <span class="premium-icon-circle">
                        <svg class="premium-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </span>
                    <span class="premium-btn-text text-buy-now">
                        BUY NOW
                    </span>
                </button>

                <!-- Premium Add to Cart Button -->
                <button wire:click="addToCart" class="premium-btn btn-blue">
                    <span class="premium-shine"></span>
                    <span class="premium-icon-circle">
                        <svg class="premium-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </span>
                    <span class="premium-btn-text text-add-cart">
                        ADD TO CART
                    </span>
                </button>
            </div>
        </div>
    @endif

    @once
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@800;900&display=swap');

    .premium-actions-wrapper {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        gap: 12px;
        background: transparent;
    }

    .premium-btn {
        position: relative;
        width: 200px;
        max-width: 100%;
        height: 54px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.22);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        padding-left: 56px;
        padding-right: 12px;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        font-family: 'Poppins', sans-serif;
        outline: none;
        -webkit-tap-highlight-color: transparent;
        flex-shrink: 1;
        background-size: 200% auto;
        will-change: transform, box-shadow, background-position;
    }

    .btn-emerald {
        background-image: linear-gradient(to right, #22C55E, #16A34A, #15803D);
    }

    .btn-blue {
        background-image: linear-gradient(to right, #3B82F6, #2563EB, #1D4ED8);
    }

    .premium-btn:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 28px 60px rgba(0, 0, 0, 0.24);
        background-position: right center;
    }

    .btn-emerald:hover {
        box-shadow: 0 28px 60px rgba(0, 0, 0, 0.24), 0 0 20px rgba(59, 130, 246, 0.3);
    }

    .btn-blue:hover {
        box-shadow: 0 28px 60px rgba(0, 0, 0, 0.24), 0 0 20px rgba(59, 130, 246, 0.4);
    }

    .premium-icon-circle {
        position: absolute;
        left: -2px;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.30);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15), inset 0 2px 10px rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .btn-emerald .premium-icon-circle {
        background: linear-gradient(to bottom right, #34d399, #10b981);
    }

    .btn-blue .premium-icon-circle {
        background: linear-gradient(to bottom right, #60a5fa, #3b82f6);
    }

    .premium-icon {
        width: 24px;
        height: 24px;
        color: #ffffff;
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: transform;
    }

    .premium-btn:hover .premium-icon {
        animation: premium-bounce-rotate 1s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    }

    @keyframes premium-bounce-rotate {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        25% { transform: translateY(-4px) rotate(8deg); }
        50% { transform: translateY(0) rotate(4deg); }
        75% { transform: translateY(-2px) rotate(8deg); }
    }

    .premium-btn-text {
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        pointer-events: none;
        color: #ffffff;
        line-height: 1.1;
        width: 100%;
        text-shadow: 0 2px 4px rgba(0,0,0,0.15);
        white-space: nowrap;
    }

    .premium-btn-text span {
        white-space: nowrap;
    }

    .text-buy-now {
        font-weight: 900;
        font-size: 17px;
        letter-spacing: 0.5px;
    }

    .text-add-cart {
        font-weight: 800;
        font-size: 17px;
        letter-spacing: 0.5px;
    }

    .premium-shine {
        position: absolute;
        top: 0;
        left: -150%;
        width: 50%;
        height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg);
        z-index: 0;
        pointer-events: none;
    }

    .premium-btn:hover .premium-shine {
        animation: premium-shine-anim 1.5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    }

    @keyframes premium-shine-anim {
        0% { left: -150%; }
        50% { left: 200%; }
        100% { left: 200%; }
    }

    .premium-ripple {
        position: absolute;
        border-radius: 50%;
        transform: scale(0);
        animation: premium-ripple-effect 600ms linear;
        background-color: rgba(255, 255, 255, 0.4);
        pointer-events: none;
        z-index: 3;
    }

    @keyframes premium-ripple-effect {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    @media (max-width: 480px) {
        .premium-actions-wrapper {
            flex-wrap: nowrap;
            gap: 8px;
        }
        .premium-btn {
            padding-left: 48px;
            padding-right: 8px;
        }
        .text-buy-now {
            font-size: 15px;
        }
        .text-add-cart {
            font-size: 13px;
        }
        .premium-icon-circle {
            width: 44px;
            height: 44px;
        }
        .premium-icon {
            width: 20px;
            height: 20px;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('click', function(e) {
            const btn = e.target.closest('.premium-btn');
            if (btn) {
                const circle = document.createElement('span');
                const diameter = Math.max(btn.clientWidth, btn.clientHeight);
                const radius = diameter / 2;
                const rect = btn.getBoundingClientRect();
                
                circle.style.width = circle.style.height = `${diameter}px`;
                circle.style.left = `${e.clientX - rect.left - radius}px`;
                circle.style.top = `${e.clientY - rect.top - radius}px`;
                circle.classList.add('premium-ripple');
                
                const existingRipple = btn.querySelector('.premium-ripple');
                if (existingRipple) {
                    existingRipple.remove();
                }
                btn.appendChild(circle);
            }
        });
    });
    </script>
    @endonce
</div>
