<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    const UPDATED_AT = null;


    protected $fillable = [
        'order_id',
        'disbursement_amount',
    ];

    public function orderس()
    {
        return $this->hasMany(Order::class);
    }
}
