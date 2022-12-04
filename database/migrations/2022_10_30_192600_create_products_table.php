<?php

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
            $table->foreignIdFor(Category::class)->cascadeOnUpdate()->nullOnDelete();
            $table->integer('default_price')->nullable();
            $table->integer('sold_qty')->default(0);
            $table->integer('stock');
            $table->string('sku')->nullable();
            $table->integer('reviews')->default(0);
            $table->float('rate')->default(0);
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
