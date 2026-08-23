<?php

use App\Models\District;
use App\Models\Thana;
use App\Services\CartService;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $phone = '';
    public string $altPhone = '';
    public string $district = '';
    public string $thana = '';
    public string $address = '';
    public string $note = '';
    public string $paymentMethod = 'cod';
    public ?int $incompleteOrderId = null;
    
    public Collection $districts;
    public Collection $thanas;
    
    public float $subtotal = 0;
    public float $deliveryCharge = 0;
    public float $total = 0;
    public float $freeDeliveryRemaining = 0;

    public function mount(CartService $cart)
    {
        $this->districts = District::orderBy('name')->get();
        $this->thanas = collect();
        
        $this->subtotal = $cart->getSubtotal();
        
        $incompleteOrderId = request()->query('incomplete_order');
        if ($incompleteOrderId) {
            $this->incompleteOrderId = $incompleteOrderId;
            $incompleteOrder = \App\Models\IncompleteOrder::find($incompleteOrderId);
            if ($incompleteOrder) {
                $this->name = $incompleteOrder->customer_name ?? '';
                $this->phone = $incompleteOrder->customer_phone ?? '';
                $this->altPhone = $incompleteOrder->customer_alt_phone ?? '';
                $this->district = $incompleteOrder->district ?? '';
                if ($this->district) {
                    $districtModel = District::where('name', $this->district)->first();
                    if ($districtModel) {
                        $this->thanas = $districtModel->thanas()->orderBy('name')->get();
                    }
                }
                $this->thana = $incompleteOrder->thana ?? '';
                $this->address = $incompleteOrder->full_address ?? '';
            }
        } elseif (auth()->check()) {
            $user = auth()->user();
            $this->name = $user->name;
            $this->phone = $user->phone;
        }
        
        $this->updateTotals($cart);
    }

    public function selectDistrict(string $value)
    {
        $this->district = $value;
        $this->updatedDistrict($value);
        $this->saveIncompleteOrder();
    }

    public function selectThana(string $value)
    {
        $this->thana = $value;
        $this->updatedThana($value);
        $this->saveIncompleteOrder();
    }

    public function updatedDistrict($value)
    {
        $this->thana = '';
        if ($value) {
            $districtModel = District::where('name', $value)->first();
            if ($districtModel) {
                $this->thanas = $districtModel->thanas()->orderBy('name')->get();
            }
        } else {
            $this->thanas = collect();
        }
        
        $this->updateTotals(app(CartService::class));
    }

    public function updateTotals(CartService $cart)
    {
        $this->deliveryCharge = $cart->calculateDeliveryCharge($this->district);
        $this->total = $this->subtotal + $this->deliveryCharge;
        $this->freeDeliveryRemaining = $cart->getFreeDeliveryRemaining();
    }

    public function updatedName($value)
    {
    }

    public function updatedPhone($value)
    {
    }

    public function updatedAddress($value)
    {
    }

    public function updatedThana($value)
    {
    }

    public function updatedAltPhone($value)
    {
    }

    public function saveIncompleteOrder()
    {
        \Log::info('saveIncompleteOrder called', ['phone' => $this->phone, 'session_id' => session()->getId()]);
        
        $filledCount = 0;
        if (!empty(trim($this->name))) $filledCount++;
        if (!empty(trim($this->phone))) $filledCount++;
        if (!empty(trim($this->district))) $filledCount++;
        if (!empty(trim($this->thana))) $filledCount++;
        if (!empty(trim($this->address))) $filledCount++;
        if (!empty(trim($this->altPhone))) $filledCount++;

        if ($filledCount < 3) {
            return;
        }

        $cartService = app(CartService::class);
        
        $cartData = [
            'items' => $cartService->getItems()->map(function($item) {
                return [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'name' => $item->product->name ?? 'Unknown',
                    'price' => $item->product->discount_price ?? $item->product->regular_price,
                ];
            })->toArray(),
            'subtotal' => $this->subtotal,
            'total' => $this->total
        ];

        \App\Models\IncompleteOrder::updateOrCreate(
            ['session_id' => session()->getId()],
            [
                'customer_name' => $this->name,
                'customer_phone' => $this->phone,
                'customer_alt_phone' => $this->altPhone,
                'district' => $this->district,
                'thana' => $this->thana,
                'full_address' => $this->address,
                'cart_data' => $cartData,
                'ip_address' => request()->ip(),
                'last_active_step' => 'checkout_form',
            ]
        );
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'district' => 'required|string',
            'thana' => 'required|string',
            'address' => 'required|string',
            'paymentMethod' => 'required|in:cod,online',
        ]);
        
        $cartService = app(CartService::class);
        
        if ($cartService->getCount() === 0) {
            session()->flash('error', 'Your cart is empty.');
            return redirect()->route('cart');
        }
        
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'invoice_number' => \App\Models\Order::generateInvoiceNumber(),
            'subtotal' => $this->subtotal,
            'delivery_charge' => $this->deliveryCharge,
            'total_amount' => $this->total,
            'payment_method' => $this->paymentMethod,
            'payment_status' => 'unpaid',
            'delivery_status' => 'pending',
            'customer_name' => $this->name,
            'customer_phone' => $this->phone,
            'customer_alt_phone' => $this->altPhone,
            'district' => $this->district,
            'thana' => $this->thana,
            'full_address' => $this->address,
            'order_note' => $this->note,
        ]);

        foreach ($cartService->getItems() as $item) {
            $unitPrice = $item->product->discount_price ?? $item->product->regular_price;
            
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $unitPrice,
            ]);
            
            if ($item->product) {
                $item->product->decrement('stock_quantity', $item->quantity);
            }
        }

        $cartService->clear();
        
        if ($this->incompleteOrderId) {
            \App\Models\IncompleteOrder::where('id', $this->incompleteOrderId)->delete();
        }
        \App\Models\IncompleteOrder::where('session_id', session()->getId())->delete();
        
        // Send SMS Notification
        app(\App\Services\SmsService::class)->sendOrderConfirmation($order);
        
        if ($this->paymentMethod === 'online') {
            $paymentUrl = app(\App\Services\SslCommerzService::class)->initiatePayment($order);
            if ($paymentUrl) {
                return redirect()->away($paymentUrl);
            }
            session()->flash('error', 'Payment gateway error. Please try again.');
        }
        
        return redirect()->route('checkout.success', $order->id);
    }
};
?>
@php
    $cartItems = app(\App\Services\CartService::class)->getItems();
@endphp

<div class="flex flex-col lg:flex-row gap-2 lg:gap-8">
    {{-- Left Column: YOUR ORDER + BILLING & SHIPPING --}}
    <div class="flex-1 space-y-2">
        
        {{-- 1. YOUR ORDER / আপনার অর্ডার Card (100% Matching Reference Screenshot) --}}
        <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-100 bg-white text-center">
                <h2 class="text-xl font-extrabold text-gray-800 tracking-wider font-bangla uppercase">YOUR ORDER</h2>
            </div>
            
            {{-- Header Row: PRODUCT ---- SUBTOTAL --}}
            <div class="bg-gray-50/80 border-b border-gray-200 px-4 py-2.5 flex justify-between items-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                <span>PRODUCT</span>
                <span>SUBTOTAL</span>
            </div>

            {{-- Product Items List --}}
            <div class="divide-y divide-gray-100">
                @foreach($cartItems as $item)
                    <div class="px-4 py-3.5 flex items-center justify-between gap-3">
                        {{-- Left: Image + Title + SKU + Quantity --}}
                        <div class="flex items-center gap-3 min-w-0 flex-1">
                            <a href="{{ route('product.show', $item->product->slug) }}" class="w-14 h-14 shrink-0 bg-white rounded border border-gray-100 overflow-hidden block p-0.5">
                                @if($item->product->cover_image_url)
                                    <img src="{{ $item->product->cover_image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain mix-blend-multiply">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </a>
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('product.show', $item->product->slug) }}" class="font-semibold text-gray-800 text-sm leading-snug line-clamp-2 hover:text-[var(--color-trust-blue)]">
                                    {{ $item->product->name }}
                                </a>
                                @if($item->product->sku)
                                    <div class="text-[11px] text-gray-400 font-mono mt-0.5">SKU: {{ $item->product->sku }}</div>
                                @endif
                                <div class="text-xs text-gray-500 font-medium mt-1">× {{ $item->quantity }}</div>
                            </div>
                        </div>

                        {{-- Right: Subtotal (Aligned level with quantity multiplier x 1) --}}
                        <div class="text-right shrink-0 self-end pb-0.5">
                            <span class="font-bold text-gray-800 text-sm">৳{{ number_format($item->product->effective_price * $item->quantity, 0) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 2. BILLING & SHIPPING / বিলিং ও শিপিং Form Card --}}
        <form wire:submit="submit" x-data x-on:submit="window.isOrderSubmitting = true" class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-5 md:p-7 border-b border-gray-100">
                <div class="text-center mb-5">
                    <h2 class="text-[26px] font-extrabold text-gray-800 tracking-wider font-bangla uppercase">BILLING & SHIPPING</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4.5 mb-4.5">
                    <div>
                        <label class="block text-xl font-semibold text-gray-800 mb-1.5">আপনার নাম / Full Name *</label>
                        <input type="text" wire:model.blur="name" class="form-input text-xl" placeholder="আপনার নাম লিখুন..." required>
                        @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xl font-semibold text-gray-800 mb-1.5">মোবাইল নাম্বার / Phone Number *</label>
                        <input type="tel" wire:model.blur="phone" class="form-input text-xl" placeholder="01XXXXXXXXX" required>
                        @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4.5 mb-4.5 min-w-0 max-w-full">
                    {{-- District Custom Dropdown (Strictly Bounded & Smooth Scrollable) --}}
                    <div x-data="{ open: false, search: '' }" class="relative min-w-0 max-w-full">
                        <label class="block text-xl font-semibold text-gray-800 mb-1.5">District / জেলা *</label>
                        
                        <div @click="open = !open" 
                             class="form-input flex items-center justify-between cursor-pointer py-2.5 px-3 bg-white text-xl select-none">
                            <span class="truncate text-gray-800 font-medium">
                                @if($district)
                                    @php $selectedD = $districts->firstWhere('name', $district); @endphp
                                    {{ $selectedD ? ($selectedD->name . ' - ' . $selectedD->bn_name) : $district }}
                                @else
                                    <span class="text-gray-400">জেলা সিলেক্ট করুন</span>
                                @endif
                            </span>
                            <svg class="w-4 h-4 text-gray-400 shrink-0 ml-2 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>

                        <div x-show="open" @click.away="open = false" x-cloak 
                             class="absolute z-50 left-0 right-0 top-full mt-1 bg-white border border-gray-200 rounded-md shadow-xl w-full text-left overflow-hidden block">
                            <div class="p-2 bg-white border-b border-gray-100">
                                <input type="text" x-model="search" placeholder="জেলা খুঁজুন..." class="w-full px-2.5 py-2 text-[18px] border border-gray-200 rounded focus:outline-none focus:border-[var(--color-trust-blue)]">
                            </div>
                            <div class="py-1 overflow-y-auto overscroll-contain touch-pan-y block" style="max-height: 400px; -webkit-overflow-scrolling: touch;">
                                @foreach($districts as $d)
                                    <div x-show="!search || {{ json_encode(strtolower($d->name . ' ' . $d->bn_name)) }}.includes(search.toLowerCase())"
                                         wire:click="selectDistrict({{ json_encode($d->name) }})"
                                         @click="open = false; search = '';"
                                         class="px-3 py-3 text-xl font-medium text-gray-700 hover:bg-blue-50 hover:text-[var(--color-trust-blue)] cursor-pointer transition-colors leading-snug {{ $district === $d->name ? 'bg-blue-50 text-[var(--color-trust-blue)] font-bold' : '' }}">
                                        {{ $d->name }} - {{ $d->bn_name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('district') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Thana Custom Dropdown (Strictly Bounded & Smooth Scrollable) --}}
                    <div x-data="{ open: false, search: '' }" class="relative min-w-0 max-w-full">
                        <label class="block text-xl font-semibold text-gray-800 mb-1.5">Thana / থানা *</label>
                        
                        <div @click="if({{ $thanas->isEmpty() ? 'false' : 'true' }}) open = !open" 
                             class="form-input flex items-center justify-between cursor-pointer py-2.5 px-3 bg-white text-xl select-none @if($thanas->isEmpty()) opacity-60 cursor-not-allowed bg-gray-50 @endif">
                            <span class="truncate text-gray-800 font-medium">
                                @if($thana)
                                    @php $selectedT = $thanas->firstWhere('name', $thana); @endphp
                                    {{ $selectedT ? ($selectedT->name . ' - ' . $selectedT->bn_name) : $thana }}
                                @else
                                    <span class="text-gray-400">থানা সিলেক্ট করুন</span>
                                @endif
                            </span>
                            <svg class="w-4 h-4 text-gray-400 shrink-0 ml-2 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>

                        @if(!$thanas->isEmpty())
                            <div x-show="open" @click.away="open = false" x-cloak 
                                 class="absolute z-50 left-0 right-0 top-full mt-1 bg-white border border-gray-200 rounded-md shadow-xl w-full text-left overflow-hidden block">
                                <div class="p-2 bg-white border-b border-gray-100">
                                    <input type="text" x-model="search" placeholder="থানা খুঁজুন..." class="w-full px-2.5 py-2 text-[18px] border border-gray-200 rounded focus:outline-none focus:border-[var(--color-trust-blue)]">
                                </div>
                                <div class="py-1 overflow-y-auto overscroll-contain touch-pan-y block" style="max-height: 400px; -webkit-overflow-scrolling: touch;">
                                    @foreach($thanas as $t)
                                        <div x-show="!search || {{ json_encode(strtolower($t->name . ' ' . $t->bn_name)) }}.includes(search.toLowerCase())"
                                             wire:click="selectThana({{ json_encode($t->name) }})"
                                             @click="open = false; search = '';"
                                             class="px-3 py-3 text-xl font-medium text-gray-700 hover:bg-blue-50 hover:text-[var(--color-trust-blue)] cursor-pointer transition-colors leading-snug {{ $thana === $t->name ? 'bg-blue-50 text-[var(--color-trust-blue)] font-bold' : '' }}">
                                            {{ $t->name }} - {{ $t->bn_name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @error('thana') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="block text-xl font-semibold text-gray-800 mb-1.5">সম্পূর্ণ ঠিকানা / Full Address *</label>
                    <textarea wire:model.blur="address" class="form-input resize-none text-xl" rows="3" placeholder="বাসা/ফ্ল্যাট নম্বর, রোড নম্বর, এলাকা লিখুন..." required></textarea>
                    @error('address') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4.5 mb-4.5">
                    <div>
                        <label class="block text-xl font-semibold text-gray-800 mb-1.5">Alternative Phone (Optional)</label>
                        <input type="tel" wire:model.blur="altPhone" class="form-input text-xl" placeholder="01XXXXXXXXX">
                    </div>
                </div>

                <div>
                    <label class="block text-xl font-semibold text-gray-800 mb-1.5">Order Note (Optional)</label>
                    <textarea wire:model="note" class="form-input resize-none text-xl" rows="2" placeholder="ডেলিভারির বিষয়ে বিশেষ কোনো তথ্য..."></textarea>
                </div>
            </div>

            <div class="p-5 md:p-7 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800 mb-4 font-bangla">পেমেন্ট মেথড</h2>
                <div class="space-y-3">
                    <label class="flex items-center p-4 border rounded cursor-pointer transition-colors hover:bg-white bg-white border-[var(--color-trust-blue)]">
                        <input type="radio" wire:model="paymentMethod" value="cod" class="w-5 h-5 text-[var(--color-trust-blue)] focus:ring-[var(--color-trust-blue)] border-gray-300">
                        <div class="ml-4 flex-1">
                            <span class="block font-bold text-gray-800 text-base">Cash on Delivery (COD)</span>
                            <span class="block text-sm text-gray-500">পণ্য হাতে পেয়ে পেমেন্ট করুন</span>
                        </div>
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </label>
                    <label class="flex items-center p-4 border rounded cursor-pointer transition-colors hover:bg-white {{ $paymentMethod === 'online' ? 'bg-white border-[var(--color-trust-blue)]' : 'border-gray-200' }}">
                        <input type="radio" wire:model="paymentMethod" value="online" class="w-5 h-5 text-[var(--color-trust-blue)] focus:ring-[var(--color-trust-blue)] border-gray-300">
                        <div class="ml-4 flex-1">
                            <span class="block font-bold text-gray-800 text-base">Online Payment (SSLCommerz)</span>
                            <span class="block text-sm text-gray-500">বিকাশ, নগদ, রকেট বা কার্ডে পেমেন্ট করুন</span>
                        </div>
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </label>
                </div>
            </div>
        </form>
    </div>

    {{-- Right Column: Order Summary --}}
    <div class="w-full lg:w-96 shrink-0">
        <div class="bg-white rounded-md shadow-sm border border-gray-200 p-3 md:p-6 sticky top-24">
            <div class="space-y-4 text-[18px] md:text-sm text-gray-600 mb-6 mt-2">
                <div class="flex justify-between">
                    <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                    <span class="font-semibold text-gray-800">৳{{ number_format($subtotal, 0) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Delivery Charge</span>
                    <span class="font-semibold text-gray-800">
                        @if($deliveryCharge == 0)
                            <span class="text-green-600 font-bold">Free</span>
                        @else
                            ৳{{ number_format($deliveryCharge, 0) }}
                        @endif
                    </span>
                </div>
            </div>

            @if($freeDeliveryRemaining > 0)
                <div class="free-delivery-banner mb-6">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>আর মাত্র <strong>৳{{ number_format($freeDeliveryRemaining, 0) }}</strong> টাকার বাজার করলেই পাচ্ছেন <strong>ফ্রি ডেলিভারি</strong>!</span>
                </div>
            @else
                <div class="bg-green-50 border border-green-200 text-green-700 px-2 md:px-4 py-3 md:py-3 rounded text-[20px] md:text-sm flex items-center justify-center gap-2 mb-6 font-bold text-center leading-tight">
                    🎉 অভিনন্দন! আপনি ফ্রি ডেলিভারি পাচ্ছেন।
                </div>
            @endif

            <div class="border-t border-gray-100 pt-4 mb-6 flex justify-between items-end">
                <span class="font-bold text-gray-800 text-xl md:text-base">Total</span>
                <span class="text-3xl md:text-2xl font-bold text-price">৳{{ number_format($total, 0) }}</span>
            </div>

            <button wire:click="submit" class="btn btn-confirm w-full py-3 md:py-3 text-2xl md:text-lg flex justify-center items-center gap-2 !bg-[#1f618d] hover:!bg-[#174a6c]">
                Confirm Order <svg class="w-5 h-5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </button>
            <div wire:loading wire:target="submit" class="text-center text-sm text-gray-500 mt-2">
                Processing your order...
            </div>
            
            <p class="text-[14px] md:text-xs text-gray-400 text-center mt-4">
                By confirming the order, you agree to our Terms of Service and Privacy Policy.
            </p>
        </div>
    </div>
</div>

@script
<script>
    window.isOrderSubmitting = false;

    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('commit', ({ component, succeed, fail }) => {
            succeed(() => {
                setTimeout(() => { window.isOrderSubmitting = false; }, 100);
            });
            fail(() => {
                window.isOrderSubmitting = false;
            });
        });
    });

    const saveIncomplete = () => {
        if (!window.isOrderSubmitting) {
            let data = {
                session_id: '{{ session()->getId() }}',
                name: $wire.name,
                phone: $wire.phone,
                district: $wire.district,
                thana: $wire.thana,
                address: $wire.address,
                altPhone: $wire.altPhone,
                _token: '{{ csrf_token() }}',
                cart_data: {
                    subtotal: $wire.subtotal,
                    total: $wire.total
                }
            };
            const blob = new Blob([JSON.stringify(data)], { type: 'application/json' });
            navigator.sendBeacon('/api/checkout/abandon', blob);
        }
    };

    document.addEventListener("visibilitychange", function() {
        if (document.visibilityState === 'hidden') {
            saveIncomplete();
        }
    });

    window.addEventListener("beforeunload", function() {
        saveIncomplete();
    });
</script>
@endscript
