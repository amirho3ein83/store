<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderItem extends Model
{

    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_PENDING = 'pending';

    use HasFactory;

    protected $fillable = [
        'order_id',
        'buyer_id',
        'product_id',
        'product_price',
        'color_id',
        'billing_total',
        'payment_status',
        'qty',
    ];

    protected $casts = [
        'qty'  =>  'integer',
    ];


    protected function billingTotal(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  convertToPersianNumber(number_format($value)),
        );
    }

    // protected function qty(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) =>  convertToPersianNumber(number_format($value)),
    //     );
    // }

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

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeIsInCart($query, $product_id, $picked_color)
    {
        return $query->where([
            ['product_id', $product_id],
            ['color_id', $picked_color],
            ['payment_status', self::PAYMENT_STATUS_PENDING]
        ]);
    }
}
