<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'description',
        'balance',
        'reviews',
        'category_id',
        'rate',

    ];

    protected $appends = ['available'];

    public static function last()
    {
        return static::all()->last();
    }

    public function getAvailableAttribute()
    {
        return $this->balance != 0 ? true : false;
    }

    public function ratings()
    {
        return Rating::where('product_id', $this->id)->avg('stars_rated');
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
}
