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
        'product_id',
        'discount_percent',
        'expiry_date',
    ];

    protected $dates = ['expiry_date'];

    protected $appends = ['remaining_time'];

    public function getRemainingTimeAttribute()
    {
        return  $this->expiry_date->diffInSeconds(Carbon::now());
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
