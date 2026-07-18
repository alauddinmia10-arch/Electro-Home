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
        
        if (auth()->check()) {
            $user = auth()->user();
            $this->name = $user->name;
            $this->phone = $user->phone;
        }
        
        $this->updateTotals($cart);
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
        
        // Send SMS Notification
        app(\App\Services\SmsService::class)->sendOrderConfirmation($order);
        
        session()->flash('success', 'আপনার অর্ডার সফলভাবে সম্পন্ন হয়েছে! ইনভয়েস: ' . $order->invoice_number);
        
        if ($this->paymentMethod === 'online') {
            $paymentUrl = app(\App\Services\SslCommerzService::class)->initiatePayment($order);
            if ($paymentUrl) {
                return redirect()->away($paymentUrl);
            }
            session()->flash('error', 'Payment gateway error. Please try again.');
        }
        
        return redirect()->route('dashboard');
    }
};
?>
<div class="flex flex-col lg:flex-row gap-8">
    {{-- Left: Checkout Form --}}
    <div class="flex-1">
        <form wire:submit="submit" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 mb-6 font-bangla">শিপিং ইনফরমেশন</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" wire:model="name" class="form-input" placeholder="Enter your full name" required>
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                        <input type="tel" wire:model="phone" class="form-input" placeholder="01XXXXXXXXX" required>
                        @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">District / জেলা *</label>
                        <select wire:model.live="district" class="form-input" required>
                            <option value="">Select District</option>
                            @foreach($districts as $d)
                                <option value="{{ $d->name }}">{{ $d->name }} - {{ $d->bn_name }}</option>
                            @endforeach
                        </select>
                        @error('district') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Thana / থানা *</label>
                        <select wire:model="thana" class="form-input" required @if($thanas->isEmpty()) disabled @endif>
                            <option value="">Select Thana</option>
                            @foreach($thanas as $t)
                                <option value="{{ $t->name }}">{{ $t->name }} - {{ $t->bn_name }}</option>
                            @endforeach
                        </select>
                        @error('thana') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Address *</label>
                    <textarea wire:model="address" class="form-input resize-none" rows="3" placeholder="House/Flat number, Road number, Area" required></textarea>
                    @error('address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alternative Phone (Optional)</label>
                        <input type="tel" wire:model="altPhone" class="form-input" placeholder="01XXXXXXXXX">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Order Note (Optional)</label>
                    <textarea wire:model="note" class="form-input resize-none" rows="2" placeholder="Any special instructions for delivery?"></textarea>
                </div>
            </div>

            <div class="p-6 md:p-8 bg-gray-50">
                <h2 class="text-xl font-bold text-gray-800 mb-6 font-bangla">পেমেন্ট মেথড</h2>
                <div class="space-y-3">
                    <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-colors hover:bg-white bg-white border-[var(--color-trust-blue)]">
                        <input type="radio" wire:model="paymentMethod" value="cod" class="w-5 h-5 text-[var(--color-trust-blue)] focus:ring-[var(--color-trust-blue)] border-gray-300">
                        <div class="ml-4 flex-1">
                            <span class="block font-bold text-gray-800 text-base">Cash on Delivery (COD)</span>
                            <span class="block text-sm text-gray-500">পণ্য হাতে পেয়ে পেমেন্ট করুন</span>
                        </div>
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </label>
                    <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-colors hover:bg-white {{ $paymentMethod === 'online' ? 'bg-white border-[var(--color-trust-blue)]' : 'border-gray-200' }}">
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

    {{-- Right: Order Summary --}}
    <div class="w-full lg:w-96 shrink-0">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sticky top-24">
            <h3 class="text-lg font-bold text-gray-800 mb-6 font-bangla border-b border-gray-100 pb-4">অর্ডার সামারি</h3>
            
            <div class="space-y-4 text-sm text-gray-600 mb-6">
                <div class="flex justify-between">
                    <span>Subtotal</span>
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
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2 mb-6 font-bold">
                    🎉 অভিনন্দন! আপনি ফ্রি ডেলিভারি পাচ্ছেন।
                </div>
            @endif

            <div class="border-t border-gray-100 pt-4 mb-6 flex justify-between items-end">
                <span class="font-bold text-gray-800">Total</span>
                <span class="text-2xl font-bold text-[var(--color-trust-blue)]">৳{{ number_format($total, 0) }}</span>
            </div>

            <button wire:click="submit" class="btn btn-confirm w-full py-3 text-lg flex justify-center items-center gap-2">
                Confirm Order <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </button>
            <div wire:loading wire:target="submit" class="text-center text-sm text-gray-500 mt-2">
                Processing your order...
            </div>
            
            <p class="text-xs text-gray-400 text-center mt-4">
                By confirming the order, you agree to our Terms of Service and Privacy Policy.
            </p>
        </div>
    </div>
</div>
