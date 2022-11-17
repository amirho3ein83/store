<?php

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
        Schema::create('addresses', function (Blueprint $table) {
            $table->morphs('addressable');
            $table->mediumText('text');
            $table->string('recipient_name');
            $table->string('postal_code');
            $table->string('mobile');
            $table->foreignIdFor(User::class)->cascadeOnDelete();
            $table->boolean('is_default')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
