<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'qty',
        'price',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function size()
    {
        return $this->morphOne(Size::class, 'sizeable');
    }

    public function pickedColor()
    {
        return $this->morphOne(Color::class, 'colorable');
    }
}
