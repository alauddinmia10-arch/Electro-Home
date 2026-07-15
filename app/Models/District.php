<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    protected $fillable = [
        'name',
        'bn_name',
        'delivery_charge',
    ];

    protected $casts = [
        'delivery_charge' => 'decimal:2',
    ];

    public function thanas(): HasMany
    {
        return $this->hasMany(Thana::class)->orderBy('name');
    }
}
