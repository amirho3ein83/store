<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderItem extends Model
{

    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_PENDING = 'pending';

    use HasFactory;

    protected $fillable = [
        'order_id',
        'buyer_id',
        'product_id',
        'picked_color',
        'picked_size',
        'billing_total',
        'payment_status',
        'qty',
    ];

    protected $casts = [
        'qty'  =>  'integer',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function scopePendingPayment($query)
    {
        return $query->where([['buyer_id', Auth::id()], ['payment_status', self::PAYMENT_STATUS_PENDING]]);
    }

    public function scopePaid($query)
    {
        return $query->where([['buyer_id', Auth::id()], ['payment_status', self::PAYMENT_STATUS_PAID]]);
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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeIsInCart($query, $product_id, $picked_color, $picked_size)
    {
        return $query->where([
            ['product_id', $product_id],
            ['picked_color', $picked_color],
            ['picked_size', $picked_size]
        ]);
    }
}
