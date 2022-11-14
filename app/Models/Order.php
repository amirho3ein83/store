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
        'user_id',
    ];


    public function scopePendingPurchase($query)
    {
        return $query->where([['user_id', Auth::id()],['status', 'pending_purchase']]);
    }

    public function scopePurchased($query)
    {
        return $query->where([['user_id', Auth::id()],['status', 'purchased']]);
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function size()
    {
        return $this->hasOne(Size::class);
    }

    public function color()
    {
        return $this->hasOne(Color::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
