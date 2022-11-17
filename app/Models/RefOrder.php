<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount_paid',
        'buyer_id',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'reforder_id');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
