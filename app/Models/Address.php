<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'text',
        'recipient_name',
        'user_id',
        'postal_code',
        'mobile'
    ];
}
