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
                    <div class="flex items-center border border-gray-200 rounded-lg bg-white overflow-hidden w-32 h-11 shrink-0">
                        <button wire:click="decrement" class="px-3 py-2 text-gray-600 hover:bg-gray-50 transition-colors h-full flex items-center justify-center" @if($quantity <= 1) disabled @endif>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                        </button>
                        <div class="flex-1 text-center font-semibold text-gray-800 border-x border-gray-200 py-2 h-full flex items-center justify-center">
                            {{ $quantity }}
                        </div>
                        <button wire:click="increment" class="px-3 py-2 text-gray-600 hover:bg-gray-50 transition-colors h-full flex items-center justify-center" @if($quantity >= $stockQuantity) disabled @endif>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </button>
                    </div>
                    <span class="text-xs text-gray-500 whitespace-nowrap hidden">Only {{ $stockQuantity }} left</span>
                </div>
                
                <div class="flex items-center h-11">
                    <button wire:click="toggleWishlist" class="flex items-center gap-2 text-gray-700 hover:text-red-500 font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        <span>Add to Wishlist</span>
                    </button>
                </div>
            </div>

            <!-- Right Column: Buy Now & Add to Cart -->
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-3">
                <!-- Premium Buy Now Button (Custom) -->
                <button wire:click="buyNow" class="custom-buy-btn">
                    <span class="custom-glass-shine"></span>
                    <span class="custom-cart-circle">
                        <svg class="custom-cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </span>
                    <span class="custom-btn-texts">
                        <span class="custom-title-buy">BUY NOW</span>
                        <span class="custom-subtitle-buy">
                            <span class="custom-line"></span>
                            SHOP WITH CONFIDENCE
                            <span class="custom-line"></span>
                        </span>
                    </span>
                </button>

                <!-- Clean Add to Cart -->
                <button wire:click="addToCart" 
                        class="h-[54px] px-8 flex items-center justify-center gap-2 border-[1.5px] border-indigo-100 bg-white text-indigo-600 hover:bg-indigo-50 hover:border-indigo-200 font-semibold rounded-full shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 active:scale-95 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span class="text-[15px]">Add to Cart</span>
                </button>
            </div>
        </div>
    @endif

    @once
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;900&display=swap');

    .custom-buy-btn {
        position: relative;
        width: 100%;
        max-width: 180px;
        height: 54px;
        border-radius: 60px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        background: linear-gradient(to right, #18C7A1, #15B76A, #14995E);
        background-size: 200% auto;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        padding-left: 55px;
        padding-right: 10px;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        font-family: 'Poppins', sans-serif;
        outline: none;
        -webkit-tap-highlight-color: transparent;
        flex-shrink: 0;
    }

    .custom-buy-btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.20);
        background-position: right center;
    }

    .custom-cart-circle {
        position: absolute;
        left: -2px;
        top: 50%;
        transform: translateY(-50%);
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(to bottom right, #17d3b4, #1185c7);
        border: 1px solid #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        transition: transform 0.4s ease;
    }

    .custom-cart-icon {
        width: 20px;
        height: 20px;
        color: #ffffff;
        transition: transform 0.4s ease;
        will-change: transform;
    }

    .custom-buy-btn:hover .custom-cart-icon {
        animation: custom-bounce-rotate 1s ease-in-out infinite;
    }

    @keyframes custom-bounce-rotate {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        25% { transform: translateY(-2px) rotate(8deg); }
        50% { transform: translateY(0) rotate(4deg); }
        75% { transform: translateY(-1px) rotate(8deg); }
    }

    .custom-btn-texts {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 1;
        pointer-events: none;
        width: 100%;
    }

    .custom-title-buy {
        font-weight: 900;
        font-size: 15px;
        color: #ffffff;
        letter-spacing: 0.5px;
        line-height: 1;
        margin-bottom: 2px;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .custom-subtitle-buy {
        display: flex;
        align-items: center;
        font-weight: 600;
        font-size: 6px;
        color: rgba(255, 255, 255, 0.95);
        letter-spacing: 1.5px;
        line-height: 1;
        white-space: nowrap;
    }

    .custom-line {
        display: inline-block;
        width: 6px;
        height: 1px;
        background-color: rgba(255, 255, 255, 0.7);
        margin: 0 3px;
    }

    .custom-glass-shine {
        position: absolute;
        top: 0;
        left: -150%;
        width: 50%;
        height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg);
        z-index: 0;
        pointer-events: none;
    }

    .custom-buy-btn:hover .custom-glass-shine {
        animation: custom-shine-anim 1.5s ease-in-out infinite;
    }

    @keyframes custom-shine-anim {
        0% { left: -150%; }
        50% { left: 200%; }
        100% { left: 200%; }
    }

    .custom-ripple {
        position: absolute;
        border-radius: 50%;
        transform: scale(0);
        animation: custom-ripple-effect 600ms linear;
        background-color: rgba(255, 255, 255, 0.4);
        pointer-events: none;
        z-index: 3;
    }

    @keyframes custom-ripple-effect {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    @media (max-width: 420px) {
        .custom-buy-btn {
            padding-left: 60px;
            height: 50px;
            max-width: 100%;
        }
        .custom-cart-circle {
            width: 52px;
            height: 52px;
        }
        .custom-cart-icon {
            width: 24px;
            height: 24px;
        }
        .custom-title-buy {
            font-size: 17px;
        }
        .custom-subtitle-buy {
            font-size: 7px;
            letter-spacing: 2px;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('click', function(e) {
            const btn = e.target.closest('.custom-buy-btn');
            if (btn) {
                const circle = document.createElement('span');
                const diameter = Math.max(btn.clientWidth, btn.clientHeight);
                const radius = diameter / 2;
                const rect = btn.getBoundingClientRect();
                
                circle.style.width = circle.style.height = `${diameter}px`;
                circle.style.left = `${e.clientX - rect.left - radius}px`;
                circle.style.top = `${e.clientY - rect.top - radius}px`;
                circle.classList.add('custom-ripple');
                
                const existingRipple = btn.querySelector('.custom-ripple');
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
