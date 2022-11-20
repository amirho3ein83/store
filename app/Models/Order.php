<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'billing_subtotal',
        'billing_tax',
        'billing_total',
        'delivery_cost',
        'status',
        'no_of_items',
    ];

    public function scopePendingPurchase($query)
    {
        return $query->where([['buyer_id', Auth::id()], ['status', 'pending_purchase']]);
    }

    public function scopePurchased($query)
    {
        return $query->where([['buyer_id', Auth::id()], ['status', 'purchased']]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
