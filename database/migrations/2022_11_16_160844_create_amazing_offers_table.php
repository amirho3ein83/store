<?php

use App\Models\Product;
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
        Schema::create('amazing_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('discount_percent');
            $table->timestamp('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amazing_offers');
    }
};
