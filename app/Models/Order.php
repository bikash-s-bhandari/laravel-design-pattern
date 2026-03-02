<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'user_id', 'status'];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
