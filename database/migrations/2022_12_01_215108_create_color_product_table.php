<?php

use App\Models\Color;
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
        Schema::create('color_product', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignIdFor(Color::class)
                ->onUpdate('cascade')
                ->nullOnDelete();

            $table->unsignedInteger('price');
            $table->unsignedInteger('stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('color_product');
    }
};
