<?php

use App\Models\Product;
use App\Models\RefOrder;
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
            $table->integer('amount_paid')->nullable();
            $table->integer('billing_subtotal')->nullable();
            $table->integer('billing_tax')->nullable();
            $table->integer('billing_total')->nullable();
            $table->string('status');
            $table->integer('no_of_items');
            $table->foreignIdFor(User::class, 'buyer_id')->cascadeOnUpdate()->nullOnDelete();
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
