<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'invoice_number',
        'subtotal',
        'delivery_charge',
        'discount_amount',
        'total_amount',
        'payment_method',
        'payment_status',
        'delivery_status',
        'customer_name',
        'customer_phone',
        'customer_alt_phone',
        'district',
        'thana',
        'full_address',
        'order_note',
        'coupon_code',
        'courier_name',
        'tracking_id',
        'assigned_staff_id',
        'transaction_id',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'delivery_charge' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    // ──── Relationships ────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function assignedStaff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_staff_id');
    }

    // ──── Scopes ────

    public function scopePending($query)
    {
        return $query->where('delivery_status', 'pending');
    }

    public function scopeProcessing($query)
    {
        return $query->where('delivery_status', 'processing');
    }

    public function scopeReadyToShip($query)
    {
        return $query->where('delivery_status', 'ready_to_ship');
    }

    public function scopeShipped($query)
    {
        return $query->where('delivery_status', 'shipped');
    }

    public function scopeDelivered($query)
    {
        return $query->where('delivery_status', 'delivered');
    }

    public function scopeCancelled($query)
    {
        return $query->where('delivery_status', 'cancelled');
    }

    public function scopeReturned($query)
    {
        return $query->where('delivery_status', 'returned');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    // ──── Helpers ────

    /**
     * Generate the next invoice number in EL-XXXX format.
     */
    public static function generateInvoiceNumber(): string
    {
        $lastOrder = static::orderByDesc('id')->first();
        $nextNumber = $lastOrder ? ((int) str_replace('EL-', '', $lastOrder->invoice_number)) + 1 : 1;

        return 'EL-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get the full delivery address as a single string.
     */
    public function getFullDeliveryAddressAttribute(): string
    {
        return "{$this->full_address}, {$this->thana}, {$this->district}";
    }

    /**
     * Check if the order can be cancelled.
     */
    public function canBeCancelled(): bool
    {
        return in_array($this->delivery_status, ['pending', 'processing']);
    }
}
