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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
            $table->foreignId('block_id')
                  ->references('id')
                  ->on('blocks')
                  ->cascadeOnDelete();
            $table->tinyInteger('temp');
            $table->timestamp('booking_at');
            $table->timestamp('booking_to');
            $table->string('access_key');
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
        Schema::dropIfExists('orders');
    }
};
