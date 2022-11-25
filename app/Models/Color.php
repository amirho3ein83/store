<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'fa_name',
        'en_name',
    ];

    public $timestamps = false;

    public function availableProducts()
    {
        // return $this->belongsToMany(Product::class, 'color_product', 'color_id', 'product_id');
    }
}
