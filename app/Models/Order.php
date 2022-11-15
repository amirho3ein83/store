<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'buyer_id',
        'picked_color',
        'picked_size',
        'amount_paid',
        'status',
    ];

    protected $casts = [
        'qty'  =>  'integer',
    ];

    public function scopePendingPurchase($query)
    {
        return $query->where([['buyer_id', Auth::id()], ['status', 'pending_purchase']]);
    }

    public function scopePurchased($query)
    {
        return $query->where([['buyer_id', Auth::id()], ['status', 'purchased']]);
    }

    public function scopeIsInCart($query, $product_id, $picked_color, $picked_size)
    {
        return $query->where([
            ['product_id', $product_id],
            ['picked_color', $picked_color],
            ['picked_size', $picked_size]
        ]);
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function buyer()
    {
        return $this->hasOne(User::class, 'id', 'buyer_id');
    }

    public function size()
    {
        return $this->hasOne(Size::class);
    }

    public function color()
    {
        return $this->hasOne(Color::class);
    }

}
