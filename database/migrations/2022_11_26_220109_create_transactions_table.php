<?php

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
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->foreignIdFor(User::class, 'payer_id');
            $table->enum('status', ['Pending', 'Successful', 'Failed'])->default('Pending');
            $table->enum('for', ['Wallet', 'Order'])->default('Order');
            $table->string('amount');
            $table->string('error')->nullable();
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
