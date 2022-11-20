<?php

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
        Schema::create('criticisms', function (Blueprint $table) {
            $table->id()->from(100);
            $table->string('critic_name')->nullable();
            $table->string('critic_email')->nullable();
            $table->string('critic_mobile');
            $table->text('desc');
            $table->timestamp('date_reported');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criticisms');
    }
};
