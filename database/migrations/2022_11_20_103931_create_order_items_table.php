<?php

use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'buyer_id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Order::class)->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Product::class)->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Color::class)->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedInteger('qty')->default(1);
            $table->unsignedInteger('billing_total')->nullable();
            $table->unsignedInteger('product_price')->nullable();
            $table->enum('payment_status', [Order::PAYMENT_STATUS_PAID, Order::PAYMENT_STATUS_PENDING])
                ->default(Order::PAYMENT_STATUS_PENDING);
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
        Schema::dropIfExists('order_items');
    }
};
