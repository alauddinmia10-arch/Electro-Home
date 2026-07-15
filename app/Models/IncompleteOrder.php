<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncompleteOrder extends Model
{
    protected $fillable = [
        'customer_phone',
        'customer_name',
        'cart_data',
        'last_active_step',
        'ip_address',
        'session_id',
    ];

    protected $casts = [
        'cart_data' => 'array',
    ];
}
