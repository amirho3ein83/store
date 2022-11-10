<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazingOffer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'expiration_date',
        'discount',
        'product_id'
    ];

    protected $appends = ['remaining_time'];

    public function getRemainingTimeAttribute()
    {
        $expiration_date = Carbon::parse($this->expiration_date);
        $now = Carbon::now();

        $remaining_seconds = $expiration_date->diffInSeconds($now);
        return $remaining_seconds;
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
