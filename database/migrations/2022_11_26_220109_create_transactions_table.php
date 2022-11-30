<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->string('reference_id')->nullable();
            $table->foreignIdFor(User::class, 'payer_id');
            $table->enum('payment_status', [Transaction::PAYMENT_STATUS_PAID, Transaction::PAYMENT_STATUS_PENDING])
                ->default(Transaction::PAYMENT_STATUS_PENDING);
            $table->enum('transactionـfor', [Transaction::TRANSACTION_FOR_ORDER, Transaction::TRANSACTION_FOR_CHARGE_WALLET])
                ->default(Transaction::TRANSACTION_FOR_ORDER);
            $table->string('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
