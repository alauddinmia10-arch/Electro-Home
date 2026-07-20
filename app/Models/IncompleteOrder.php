<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncompleteOrder extends Model
{
    use \App\Traits\NotifiesAdmins;

    protected $fillable = [
        'customer_phone',
        'customer_name',
        'customer_alt_phone',
        'district',
        'thana',
        'full_address',
        'cart_data',
        'last_active_step',
        'ip_address',
        'session_id',
    ];

    protected $casts = [
        'cart_data' => 'array',
    ];
}
