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
        'postal_code',
        'mobile',
        'is_default',
        'user_id',
        'addressable_id',
        'addressable_type',
    ];

    protected $casts = [
        'is_default'  =>  'boolean',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
