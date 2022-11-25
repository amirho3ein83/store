<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'body',
        'recipient_name',
        'zipcode',
        'mobile',
        'addressable_id',
        'addressable_type',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
