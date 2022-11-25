<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attributes';

    public $timestamps = false;

    protected $fillable = ['product_id', 'price', 'color_id', 'size_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function qty()
    {
        return $this->hasOne(ProductAttributeQty::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
