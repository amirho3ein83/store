<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('billing_subtotal')->nullable();
            $table->integer('billing_tax')->nullable();
            $table->integer('billing_total')->nullable();
            $table->integer('delivery_cost')->nullable();
            $table->enum('payment_status', [Order::PAYMENT_STATUS_PAID, Order::PAYMENT_STATUS_PENDING])
                ->default(Order::PAYMENT_STATUS_PENDING);
            $table->foreignIdFor(User::class, 'buyer_id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Transaction::class)->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('carts');
    }
};
