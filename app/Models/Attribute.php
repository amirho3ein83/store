<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'name',
        'slug'
    ];

    public $timestamps = false;

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
}
