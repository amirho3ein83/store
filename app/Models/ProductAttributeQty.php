<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeQty extends Model
{
    use HasFactory;

    protected $table = 'product_attribute_qty';

    public $timestamps = false;

    protected $fillable = ['product_attribute_id', 'qty'];
}
