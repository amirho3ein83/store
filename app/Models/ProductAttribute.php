<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAttribute extends Model
{
    use HasFactory;

    protected $table = 'order_attributes';

    protected $fillable = ['product_id', 'quantity', 'price', 'color', 'size'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributesValues()
    {
        return $this->belongsToMany(AttributeValue::class);
    }
}
