<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use Morilog\Jalali\CalendarUtils;

class Order extends Model
{

    use SoftDeletes;
    use HasFactory;

    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_PENDING = 'pending';





    protected $fillable = [
        'buyer_id',
        'billing_subtotal',
        'billing_tax',
        'billing_total',
        'delivery_cost',
        'payment_status',
        'transaction_id',
    ];

    protected $dates = ['created_at', 'updated_at'];

    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->toFormattedDateString();
    // }

    protected $appends = [
        'j_created_at',
        'j_updated_at',
        // 'j_deleted_at',
    ];

    public function getJCreatedAtAttribute()
    {
        return \is_null(Carbon::parse($this->created_at)) ? null : CalendarUtils::convertNumbers(
            Jalalian::fromCarbon(Carbon::parse($this->created_at))->format('Y/m/d H:i')
        );
    }

    public function getJUpdatedAtAttribute()
    {
        return \is_null(Carbon::parse($this->updated_at)) ? null : CalendarUtils::convertNumbers(
            Jalalian::fromCarbon(Carbon::parse($this->updated_at))->format('Y/m/d H:i')
        );
    }

    // public function getJDeletedAtAttribute()
    // {
    //     return \is_null(Carbon::parse($this->deleted_at)) ? null : CalendarUtils::convertNumbers(
    //         Jalalian::fromCarbon(Carbon::parse($this->deleted_at))->format('Y/m/d H:i')
    //     );
    // }

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
        return $this->hasMany(OrderItem::class)->with('color');
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
