<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image_path',
        'media_id',
        'sort_order',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(\Awcodes\Curator\Models\Media::class, 'media_id');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->media) {
            return $this->media->url;
        }
        return $this->image_path ? \Illuminate\Support\Facades\Storage::url($this->image_path) : '';
    }
}
