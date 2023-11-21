<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;


class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    use Sluggable;
    use HasFactory;


    protected $fillable = [
        'title',
        'slug',
        'sold_qty',
        'default_price',
        'details',
        'description',
        'reviews',
        'rate',
        'sku',
        'stock',
    ];

    protected $casts = [
        'reviews'  =>  'integer',
        'rate'  =>  'float',
        'payment_status'    =>  'boolean',
        'created_at' => 'date:Y-m-d',
    ];



    // protected $appends = ['discounted_price '];

    // public function getDicountedPriceAttribute()
    // {
    //     return $this->price * (1 - $this->discount / 100);
    // }

    
    // protected $appends = ['available'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
            // 'title-slug' => [
            //     'source' => 'title'
            // ],
            // 'author-slug' => [
            //     'source' => ['author.firstname', 'author.lastname']
            // ],
        ];
    }

    public static function last()
    {
        return static::all()->last();
    }

    public function getAvailableAttribute()
    {
        // return $this->stock != 0 ? true : false;
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
        return $this->belongsToMany(Color::class, 'color_product', 'product_id', 'color_id')->withPivot('price', 'stock')->wherePivot('stock', '>=', 1);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
