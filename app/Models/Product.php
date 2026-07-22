<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

    protected static function booted()
    {
        $clearCache = function () {
            \Illuminate\Support\Facades\Cache::forget('home.new_arrivals');
            \Illuminate\Support\Facades\Cache::forget('home.best_sellers');
            \Illuminate\Support\Facades\Cache::forget('home.featured');
            \Illuminate\Support\Facades\Cache::forget('home.flash_sale');
        };

        static::saved($clearCache);
        static::deleted($clearCache);
    }

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'barcode',
        'regular_price',
        'discount_price',
        'stock_quantity',
        'alert_stock',
        'cover_image',
        'description',
        'specifications',
        'status',
        'is_featured',
        'is_flash_sale',
        'flash_sale_ends_at',
        'total_sold',
    ];

    protected $casts = [
        'regular_price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'specifications' => 'array',
        'is_featured' => 'boolean',
        'is_flash_sale' => 'boolean',
        'flash_sale_ends_at' => 'datetime',
    ];

    // ──── Relationships ────

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function wholesaleRequests(): HasMany
    {
        return $this->hasMany(WholesaleRequest::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function restockRequests(): HasMany
    {
        return $this->hasMany(RestockRequest::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'sku' => $this->sku,
            'category_id' => $this->category_id,
        ];
    }

    // ──── Scopes ────

    public function scopeInStock($query)
    {
        return $query->where('status', 'in_stock')->where('stock_quantity', '>', 0);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where(function ($q) {
            $q->where('status', 'out_of_stock')->orWhere('stock_quantity', '<=', 0);
        });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeFlashSale($query)
    {
        return $query->where('is_flash_sale', true)
            ->where('flash_sale_ends_at', '>', now());
    }

    public function scopeBestSellers($query)
    {
        return $query->orderByDesc('total_sold');
    }

    // ──── Accessors ────

    public function getEffectivePriceAttribute(): float
    {
        return $this->discount_price && $this->discount_price < $this->regular_price
            ? (float) $this->discount_price
            : (float) $this->regular_price;
    }

    public function getDiscountPercentageAttribute(): int
    {
        if (!$this->discount_price || $this->discount_price >= $this->regular_price) {
            return 0;
        }

        return (int) round((($this->regular_price - $this->discount_price) / $this->regular_price) * 100);
    }

    public function getIsInStockAttribute(): bool
    {
        return $this->status === 'in_stock' && $this->stock_quantity > 0;
    }

    // ──── Helpers ────

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function decrementStock(int $quantity): void
    {
        $this->decrement('stock_quantity', $quantity);
        $this->increment('total_sold', $quantity);

        if ($this->stock_quantity <= 0) {
            $this->update(['status' => 'out_of_stock']);
        }
    }

    public function incrementStock(int $quantity): void
    {
        $this->increment('stock_quantity', $quantity);

        if ($this->stock_quantity > 0 && $this->status === 'out_of_stock') {
            $this->update(['status' => 'in_stock']);
        }
    }
}
