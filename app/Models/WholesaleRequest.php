<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WholesaleRequest extends Model
{
    use \App\Traits\NotifiesAdmins;

    protected $fillable = [
        'product_id',
        'quantity',
        'name',
        'phone',
        'email',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
