<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sizeable_type',
        'sizeable_id',
    ];

    public $timestamps = false;

    public function sizeable()
    {
        return $this->morphTo();
    }
}
