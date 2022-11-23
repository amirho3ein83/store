<?php

use App\Models\Order;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(User::class,'created_by')->nullable();
            $table->foreignIdFor(User::class,'updated_by')->nullable();
            $table->string('status')->default('not_paid');
            $table->string('request_info')->nullable();
            $table->string('request_verify')->nullable();
            $table->string('bank');
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
        Schema::dropIfExists('payments');
    }
};
