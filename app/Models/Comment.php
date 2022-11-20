<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'author_id',
        'body',
    ];
    protected $dates = ['created_at'];

    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->diffForHumans();
    }
}
