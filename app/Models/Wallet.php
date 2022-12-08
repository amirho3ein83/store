<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'balance',
        'user_id',
    ];

    protected $casts = [
        'balance'  =>  'integer',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
