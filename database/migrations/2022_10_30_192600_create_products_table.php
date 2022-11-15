<?php

use App\Models\Brand;
use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('price')->nullable();
            $table->integer('sale_price')->nullable();
            $table->integer('sold_qty')->default(0);
            $table->foreignIdFor(Category::class)
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Brand::class)
                ->nullable()->cascadeOnUpdate()->nullOnDelete();
            $table->integer('stock');
            $table->integer('reviews')->default(0);
            $table->float('rate')->default(0);
            $table->boolean('featured')->default(0);
            $table->mediumText('description');
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
        Schema::dropIfExists('products');
    }
};
