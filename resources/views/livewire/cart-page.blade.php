<?php

use App\Services\CartService;
use Livewire\Volt\Component;

new class extends Component {
    public $quantities = [];

    public function mount()
    {
        foreach (app(CartService::class)->getItems() as $item) {
            $this->quantities[$item->product_id] = $item->quantity;
        }
    }

    public function updatedQuantities($value, $key)
    {
        \Illuminate\Support\Facades\Log::info("updatedQuantities hook fired for key: " . $key . " with value: " . $value);
        $productId = (int) $key;
        $quantity = (int) $value;

        $item = app(CartService::class)->getItems()->firstWhere('product_id', $productId);
        if ($item) {
            $stock = $item->product->stock_quantity ?? 999;
            if ($quantity > $stock) $quantity = $stock;
            if ($quantity < 1) $quantity = 1;
            
            $this->quantities[$productId] = $quantity;
            $this->updateQuantity($productId, $quantity);
        }
    }

    public function updated($property, $value)
    {
        \Illuminate\Support\Facades\Log::info("Updated hook fired for property: " . $property . " with value: " . $value);
        if (str_starts_with($property, 'quantities.')) {
            $productId = (int) str_replace('quantities.', '', $property);
            $quantity = (int) $value;

            $item = app(CartService::class)->getItems()->firstWhere('product_id', $productId);
            if ($item) {
                $stock = $item->product->stock_quantity ?? 999;
                if ($quantity > $stock) $quantity = $stock;
                if ($quantity < 1) $quantity = 1;
                
                $this->quantities[$productId] = $quantity;
                $this->updateQuantity($productId, $quantity);
            }
        }
    }

    public function incrementQuantity(int $productId)
    {
        $item = app(CartService::class)->getItems()->firstWhere('product_id', $productId);
        if ($item) {
            $stock = $item->product->stock_quantity ?? 999;
            $current = $item->quantity;
            if ($current < $stock) {
                $this->quantities[$productId] = $current + 1;
                $this->updateQuantity($productId, $current + 1);
            }
        }
    }

    public function decrementQuantity(int $productId)
    {
        $item = app(CartService::class)->getItems()->firstWhere('product_id', $productId);
        if ($item) {
            $current = $item->quantity;
            if ($current > 1) {
                $this->quantities[$productId] = $current - 1;
                $this->updateQuantity($productId, $current - 1);
            }
        }
    }


    public function updateQuantity(int $productId, int $quantity)
    {
        \Illuminate\Support\Facades\Log::info("updateQuantity called for product: " . $productId . " with qty: " . $quantity);
        $cart = app(CartService::class);
        $cart->updateQuantity($productId, $quantity);
        $this->dispatch('cart-updated', count: $cart->getCount(), subtotal: $cart->getSubtotal());
    }

    public function removeItem(int $productId)
    {
        $cart = app(CartService::class);
        $cart->remove($productId);
        unset($this->quantities[$productId]);
        $this->dispatch('cart-updated', count: $cart->getCount(), subtotal: $cart->getSubtotal());
    }

    public function with(): array
    {
        $cart = app(CartService::class);
        return [
            'items' => $cart->getItems(),
            'subtotal' => $cart->getSubtotal(),
            'freeDeliveryRemaining' => $cart->getFreeDeliveryRemaining(),
        ];
    }
};
?>
<div class="bg-gray-100 py-6">
    <div class="max-w-[1440px] mx-auto px-4 xl:px-[70px]">
        <h1 class="text-2xl font-bold text-gray-800 font-bangla mb-6">আপনার শপিং কার্ট</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Left: Cart Items --}}
            <div class="flex-1">
                <div class="bg-white rounded shadow-sm border border-gray-200 overflow-hidden">
                    @if($items->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 border-b border-gray-200 text-sm text-gray-600 uppercase">
                                    <tr>
                                        <th class="px-6 py-4 font-semibold">Product</th>
                                        <th class="px-6 py-4 font-semibold text-center">Price</th>
                                        <th class="px-6 py-4 font-semibold text-center">Quantity</th>
                                        <th class="px-6 py-4 font-semibold text-right">Subtotal</th>
                                        <th class="px-6 py-4"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($items as $item)
                                        <tr wire:key="cart-item-{{ $item->product_id }}" x-data="{ 
                                            qty: {{ $quantities[$item->product_id] ?? 1 }}, 
                                            stock: {{ $item->product->stock_quantity ?? 999 }},
                                            timeout: null,
                                            updateQty(change, price) {
                                                if (this.qty + change < 1 || this.qty + change > this.stock) return;
                                                this.qty += change;
                                                window.dispatchEvent(new CustomEvent('cart-updated-optimistic', { detail: { amount: price * change, qty_change: change } }));
                                                clearTimeout(this.timeout);
                                                this.timeout = setTimeout(() => {
                                                    $wire.updateQuantity({{ $item->product_id }}, this.qty);
                                                }, 500);
                                            }
                                        }">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-4">
                                                    <a href="{{ route('product.show', $item->product->slug) }}" class="w-16 h-16 shrink-0 bg-gray-50 rounded border border-gray-100 overflow-hidden block">
                                                        @if($item->product->cover_image)
                                                            <img src="{{ Storage::url($item->product->cover_image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain mix-blend-multiply">
                                                        @else
                                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                            </div>
                                                        @endif
                                                    </a>
                                                    <div>
                                                        <a href="{{ route('product.show', $item->product->slug) }}" class="font-semibold text-gray-800 hover:text-[var(--color-trust-blue)] transition-colors line-clamp-2">
                                                            {{ $item->product->name }}
                                                        </a>
                                                        <div class="text-xs text-gray-500 mt-1">SKU: {{ $item->product->sku }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="font-semibold text-gray-700">৳{{ number_format($item->product->effective_price, 0) }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center">
                                                    <div class="flex items-center border border-gray-200 rounded bg-gray-50">
                                                        <button type="button" @click="updateQty(-1, {{ $item->product->effective_price }})" class="px-2 py-1 text-gray-500 hover:text-black hover:bg-gray-200 transition-colors" :disabled="qty <= 1">-</button>
                                                        <input type="text" x-model="qty" class="w-10 text-center text-sm font-semibold bg-transparent border-x border-gray-200 py-1" readonly>
                                                        <button type="button" @click="updateQty(1, {{ $item->product->effective_price }})" class="px-2 py-1 text-gray-500 hover:text-black hover:bg-gray-200 transition-colors" :disabled="qty >= stock">+</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <span wire:ignore class="font-bold text-[var(--color-trust-blue)] text-lg" x-text="'৳' + new Intl.NumberFormat('en-US').format({{ $item->product->effective_price }} * qty)">৳{{ number_format($item->product->effective_price * $item->quantity, 0) }}</span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <button wire:click="removeItem({{ $item->product_id }})" class="p-2 text-red-400 hover:bg-red-50 hover:text-red-600 rounded transition-colors" title="Remove Item">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-12 text-center flex flex-col items-center justify-center">
                            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-6">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">আপনার কার্ট খালি!</h3>
                            <p class="text-gray-500 mb-8">এখনও কোনো প্রোডাক্ট যুক্ত করা হয়নি।</p>
                            <a href="{{ route('shop') }}" class="btn btn-primary px-8">শপিং শুরু করুন</a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Order Summary --}}
            @if($items->count() > 0)
                <div class="w-full lg:w-96 shrink-0">
                    <div class="bg-white rounded shadow-sm border border-gray-200 p-6 sticky top-24" x-data="{ orderSubtotal: {{ $subtotal }}, orderQty: {{ $items->sum('quantity') }} }" @cart-updated-optimistic.window="orderSubtotal += $event.detail.amount; orderQty += $event.detail.qty_change" @cart-updated.window="if($event.detail.subtotal !== undefined) { orderSubtotal = $event.detail.subtotal; orderQty = $event.detail.count; }">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 font-bangla border-b border-gray-100 pb-4">অর্ডার সামারি</h3>
                        
                        <div class="space-y-4 text-sm text-gray-600 mb-6">
                            <div class="flex justify-between">
                                <span>Subtotal (<span wire:ignore x-text="orderQty">{{ $items->sum('quantity') }}</span> items)</span>
                                <span class="font-semibold text-gray-800" wire:ignore x-text="'৳' + new Intl.NumberFormat('en-US').format(orderSubtotal)">৳{{ number_format($subtotal, 0) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Delivery Charge</span>
                                <span>Calculated at checkout</span>
                            </div>
                        </div>
                        
                        @if($freeDeliveryRemaining > 0)
                            <div class="free-delivery-banner mb-6">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>আর মাত্র <strong>৳{{ number_format($freeDeliveryRemaining, 0) }}</strong> টাকার বাজার করলেই পাচ্ছেন <strong>ফ্রি ডেলিভারি</strong>!</span>
                            </div>
                        @else
                            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded text-sm flex items-center gap-2 mb-6 font-bold">
                                🎉 অভিনন্দন! আপনি ফ্রি ডেলিভারি পাচ্ছেন।
                            </div>
                        @endif

                        <div class="border-t border-gray-100 pt-4 mb-6 flex justify-between items-end">
                            <span class="font-bold text-gray-800">Estimated Total</span>
                            <span class="text-2xl font-bold text-price" wire:ignore x-text="'৳' + new Intl.NumberFormat('en-US').format(orderSubtotal)">৳{{ number_format($subtotal, 0) }}</span>
                        </div>

                        <a href="{{ route('checkout') }}" class="btn btn-primary w-full py-3 text-lg flex justify-center items-center gap-2">
                            Checkout Now <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        
                        <a href="{{ route('shop') }}" class="block text-center text-[var(--color-trust-blue)] hover:underline mt-4 text-sm font-semibold">
                            &larr; Continue Shopping
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
