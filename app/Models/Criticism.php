<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criticism extends Model
{
    use HasFactory;

    public $timestamps = false;

    const UPDATED_AT = null;

    protected $fillable = [
        'desc',
        'critic_mobile',
        'critic_email',
        'critic_name'
    ];

    protected $dates = ['date_reported'];
}
