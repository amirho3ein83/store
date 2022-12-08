<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;
    use Sluggable;



    public $timestamps = false;

    protected $fillable = [
        'name',
        'parent_id',
        'slug',

    ];

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
                'source' => 'name'
            ]
            // 'title-slug' => [
            //     'source' => 'title'
            // ],
            // 'author-slug' => [
            //     'source' => ['author.firstname', 'author.lastname']
            // ],
        ];
    }

    public function scopeMain($query)
    {
        return $query->main();
    }

    public function scopeSub($query)
    {
        return $query->sub();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'category_attribute', 'category_id', 'attribute_id');
    }
}
