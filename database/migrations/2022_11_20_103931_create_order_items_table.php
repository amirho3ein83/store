<?php

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
            $table->foreignIdFor(Product::class)->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Order::class)->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(User::class, 'buyer_id')->cascadeOnUpdate()->nullOnDelete();
            $table->integer('qty')->default(1);
            $table->string('picked_color');
            $table->string('picked_size');
            $table->string('status');
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
