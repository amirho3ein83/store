<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'colorable_type',
        'colorable_id',
    ];

    public $timestamps = false;

    public function colorable()
    {
        return $this->morphTo();
    }
}
