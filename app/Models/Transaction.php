<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Transaction extends Model
{

    const STATUS_PAID = 'paid';
    const STATUS_PENDING = 'pending';
    const STATUS_FAILED = 'failed';

    const TRANSACTION_FOR_ORDER = 'order';
    const TRANSACTION_FOR_CHARGE_WALLET = 'wallet';

    use HasFactory;

    protected $fillable = [
        'payer_id',
        'transaction_id',
        'reference_id',
        'payment_status',
        'transactionـfor',
        'error',
        'amount'
    ];
}
