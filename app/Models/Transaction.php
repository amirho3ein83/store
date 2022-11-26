<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'payer_id',
        'transaction_id',
        'reference_id',
        'status',
        'for',
        'error',
        'amount'
    ];
}
