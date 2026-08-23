<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Str;

class LandingPage extends Component
{
    public $product;
    
    // Checkout fields
    public $name;
    public $phone;
    public $address;
    public $note;
    
    // Cart details
    public $quantity = 1;
    public $delivery_area = 'inside_dhaka';
    public $delivery_charge = 70;
    
    // Upsells
    public $suggested_products;
    public $upsell_products = [];

    public function updatedDeliveryArea($value)
    {
        if ($value === 'inside_dhaka') {
            $this->delivery_charge = 70;
        } elseif ($value === 'outside_dhaka') {
            $this->delivery_charge = 130;
        }
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
    ];

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
        $this->suggested_products = Product::where('status', 'in_stock')
            ->where('id', '!=', $this->product->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
    }

    public function getUpsellTotalProperty()
    {
        $total = 0;
        if (is_array($this->upsell_products)) {
            foreach ($this->upsell_products as $id) {
                if ($id) {
                    $p = $this->suggested_products->firstWhere('id', $id);
                    if ($p) $total += $p->effective_price;
                }
            }
        }
        return (float) $total;
    }

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function placeOrder()
    {
        $this->validate();

        $upsellTotal = $this->upsell_total;
        $subtotal = ($this->product->effective_price * $this->quantity) + $upsellTotal;
        $total = $subtotal + $this->delivery_charge;

        // Generate Invoice Number
        $lastOrder = Order::latest('id')->first();
        $nextId = $lastOrder ? $lastOrder->id + 1 : 1;
        $invoiceNumber = 'EH' . str_pad($nextId, 6, '0', STR_PAD_LEFT);

        $order = Order::create([
            'invoice_number' => $invoiceNumber,
            'user_id' => auth()->id() ?? null,
            'customer_name' => $this->name,
            'customer_phone' => $this->phone,
            'district' => $this->delivery_area === 'inside_dhaka' ? 'Dhaka' : 'Outside Dhaka',
            'thana' => 'N/A',
            'full_address' => $this->address,
            'order_note' => $this->note,
            'subtotal' => $subtotal,
            'delivery_charge' => $this->delivery_charge,
            'total_amount' => $total,
            'delivery_status' => 'pending',
            'payment_method' => 'cod',
            'payment_status' => 'unpaid',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'quantity' => $this->quantity,
            'unit_price' => $this->product->effective_price,
        ]);
        
        if ($this->product) {
            $this->product->decrement('stock_quantity', $this->quantity);
        }

        if (is_array($this->upsell_products)) {
            foreach ($this->upsell_products as $id) {
                if ($id) {
                    $p = $this->suggested_products->firstWhere('id', $id);
                    if ($p) {
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $p->id,
                            'quantity' => 1,
                            'unit_price' => $p->effective_price,
                        ]);
                        $p->decrement('stock_quantity', 1);
                    }
                }
            }
        }
        
        // Send SMS Notification
        app(\App\Services\SmsService::class)->sendOrderConfirmation($order);

        return redirect()->route('checkout.success', $order->id)->with('success', 'Your order has been placed successfully!');
    }

    public function render()
    {
        return view('livewire.landing-page')->layout('components.layouts.app');
    }
}
