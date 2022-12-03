<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'sold_qty',
        'default_price',
        'details',
        'description',
        'stock',
        'reviews',
        'rate',
        'sku',
    ];

    protected $casts = [
        'reviews'  =>  'integer',
        'rate'  =>  'float',
        'payment_status'    =>  'boolean',
        'created_at' => 'date:Y-m-d',
    ];

    protected $appends = ['available'];

    public  function slug()
    {
        return Str::slug($this->title);
    }

    // protected function reviews(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => number_format($value),
    //     );
    // }

    public static function last()
    {
        return static::all()->last();
    }

    public function getAvailableAttribute()
    {
        return $this->stock != 0 ? true : false;
    }


    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'liked_products', 'product_id', 'liked_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->with('author');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function availableColors()
    {
        return $this->belongsToMany(Color::class, 'color_product', 'product_id', 'color_id')->withPivot('price', 'stock');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
