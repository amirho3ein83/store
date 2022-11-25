<?php

namespace App\Models;

use DateTimeInterface;
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


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->toFormattedDateString();
    }

    public function scopePending($query)
    {
        return $query->where([['buyer_id', Auth::id()], ['status', 'pending']]);
    }

    public function scopeCompleted($query)
    {
        return $query->where([['buyer_id', Auth::id()], ['status', 'completed']]);
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
