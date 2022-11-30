<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

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
        'transaction_id',
    ];


    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->toFormattedDateString();
    // }


    protected function billingTotal(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  convertToPersianNumber(number_format($value)),
        );
    }
    
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => convertToPersianNumber(Jalalian::fromCarbon(Carbon::parse($value))->format('Y/m/d H:i'))
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

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
