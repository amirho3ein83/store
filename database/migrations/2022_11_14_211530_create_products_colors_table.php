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
        Schema::create('products_colors', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Color::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_colors');
    }
};
