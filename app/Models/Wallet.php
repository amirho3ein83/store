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
        'balance'
    ];

    protected $casts = [
        'balance'  =>  'integer',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    protected function balance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  convertToPersianNumber(number_format($value)),
        );
    }
}
