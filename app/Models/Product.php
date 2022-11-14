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
        'price',
        'sold_qty',
        'sale_price',
        'description',
        'stock',
        'reviews',
        'category_id',
        'brand_id',
        'rate',
        'featured',

    ];

    protected $casts = [
        'reviews'  =>  'integer',
        'rate'  =>  'integer',
        'status'    =>  'boolean',
        'featured'  =>  'boolean'
    ];

    protected $appends = ['available'];

    public  function slug()
    {
        return Str::slug($this->title);
    }

    public static function last()
    {
        return static::all()->last();
    }

    public function getAvailableAttribute()
    {
        return $this->stock != 0 ? true : false;
    }

    public function ratings()
    {
        return Rating::where('product_id', $this->id)->avg('stars_rated');
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function availableSizes()
    {
        return $this->belongsToMany(Size::class, 'products_sizes');
    }

    public function availableColors()
    {
        return $this->belongsToMany(Color::class, 'products_colors');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function attributes()
    {
        return $this->hasMany(OrderAttribute::class);
    }
}
