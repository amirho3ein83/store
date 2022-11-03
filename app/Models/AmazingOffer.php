<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazingOffer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'expiration_date',
        'product_id'
    ];
}
