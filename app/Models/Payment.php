<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'buyer_id',
        'status',
        'request_info',
        'verify_info',
        'bank',
    ];

    public function buyer()
    {
        return $this->hasOne(User::class, 'id', 'buyer_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
