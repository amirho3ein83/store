<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attributes';

    public $timestamps = false;

    protected $fillable = ['product_id', 'price', 'color', 'size'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function qty()
    {
        return $this->hasOne(ProductAttributeQty::class);
    }
}
