<?php

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Size;
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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Size::class)->nullable()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Color::class)->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('price')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes_qty');
    }
};
