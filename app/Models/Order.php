<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{

    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_PENDING = 'pending';




    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'billing_subtotal',
        'billing_tax',
        'billing_total',
        'delivery_cost',
        'payment_status',
    ];


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->toFormattedDateString();
    }

    protected function billingTotal(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  convertToPersianNumber(number_format($value)),
        );
    }

    public function scopePendingPayment($query)
    {
        return $query->where([['buyer_id', Auth::id()], ['payment_status', self::PAYMENT_STATUS_PENDING]]);
    }

    public function scopePaid($query)
    {
        return $query->where([['buyer_id', Auth::id()], ['payment_status', self::PAYMENT_STATUS_PAID]]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function buyer()
    {
        return $this->hasOne(User::class, 'id', 'buyer_id');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
