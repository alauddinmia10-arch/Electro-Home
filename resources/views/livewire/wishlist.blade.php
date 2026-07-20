<?php

use App\Models\Wishlist;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use App\Services\CartService;

new #[Layout('layouts.app')] #[Title('My Wishlist - Electrohome.bd')] class extends Component {
    public Collection $wishlistItems;

    public function mount()
    {
        $this->loadWishlist();
    }

    public function loadWishlist()
    {
        $this->wishlistItems = Auth::user()->wishlists()->with('product')->get();
    }

    public function removeFromWishlist($wishlistId)
    {
        Auth::user()->wishlists()->where('id', $wishlistId)->delete();
        $this->loadWishlist();
    }

    public function moveToCart($wishlistId, CartService $cart)
    {
        $wishlistItem = Auth::user()->wishlists()->where('id', $wishlistId)->first();
        if ($wishlistItem && $wishlistItem->product) {
            $cart->add($wishlistItem->product_id, 1);
            $wishlistItem->delete();
            $this->dispatch('cart-updated');
            session()->flash('success', 'Product moved to cart!');
            $this->loadWishlist();
        }
    }
} ?>

<div class="bg-gray-50 py-10 min-h-[calc(100vh-200px)]">
    <div class="max-w-[1440px] mx-auto px-4 xl:px-[70px]">
        <h2 class="text-2xl font-bold text-gray-800 font-bangla mb-6">আমার উইশলিস্ট</h2>
        
        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if($wishlistItems->isEmpty())
            <div class="bg-white p-12 rounded-xl shadow-sm border border-gray-100 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">উইশলিস্ট খালি!</h3>
                <p class="text-gray-500 mb-6">আপনার উইশলিস্টে কোন প্রোডাক্ট নেই।</p>
                <a href="{{ route('shop') }}" class="btn btn-primary inline-flex">কেনাকাটা শুরু করুন</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($wishlistItems as $item)
                    @if($item->product)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group">
                            <div class="relative h-48 bg-gray-100 p-4 flex items-center justify-center">
                                @if($item->product->cover_image)
                                    <img src="{{ Storage::url($item->product->cover_image) }}" alt="{{ $item->product->name }}" class="max-h-full object-contain">
                                @else
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                @endif
                                
                                <button wire:click="removeFromWishlist({{ $item->id }})" class="absolute top-2 right-2 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-white shadow-sm transition-all" title="Remove">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                            
                            <div class="p-4 flex flex-col h-[calc(100%-12rem)]">
                                <a href="{{ route('product.show', $item->product->slug) }}" class="text-sm font-semibold text-gray-800 hover:text-trust-blue line-clamp-2 mb-2 flex-1">
                                    {{ $item->product->name }}
                                </a>
                                
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-lg font-bold text-soft-coral">৳{{ number_format($item->product->discount_price ?? $item->product->regular_price, 0) }}</span>
                                </div>
                                
                                @if($item->product->stock_quantity > 0)
                                    <button wire:click="moveToCart({{ $item->id }})" class="btn btn-primary w-full text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                                        Move to Cart
                                    </button>
                                @else
                                    <button class="btn btn-neutral w-full text-sm" disabled>
                                        Out of Stock
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
