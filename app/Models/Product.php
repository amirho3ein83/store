<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'price',
        'sold_qty',
        'sale_price',
        'details',
        'description',
        'stock',
        'reviews',
        'brand_id',
        'rate',
        'featured',

    ];

    protected $casts = [
        'reviews'  =>  'integer',
        'rate'  =>  'integer',
        'status'    =>  'boolean',
        'created_at' => 'date:Y-m-d',
        'featured'  =>  'boolean'
    ];

    protected $appends = ['available'];

    public  function slug()
    {
        return Str::slug($this->title);
    }

    protected function salePrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value + 0,
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value + 0,
        );
    }

    public static function last()
    {
        return static::all()->last();
    }

    public function getAvailableAttribute()
    {
        return $this->stock != 0 ? true : false;
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'liked_products', 'product_id', 'liked_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function availableSizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function availableColors()
    {
        return $this->belongsToMany(Color::class, 'color_product', 'product_id', 'color_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
