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
            $table->string('slug');
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->integer('sold_qty')->default(0);
            $table->foreignIdFor(Brand::class)
                ->index()->nullable()->cascadeOnUpdate()->nullOnDelete();
            $table->integer('stock');
            $table->integer('reviews')->default(0);
            $table->float('rate')->default(0);
            $table->boolean('featured')->default(0);
            $table->mediumText('details');
            $table->text('description');
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
