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
        Schema::create('block_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                  ->references('id')
                  ->on('orders')
                  ->cascadeOnDelete();
            $table->foreignId('block_id')
                  ->references('id')
                  ->on('blocks')
                  ->cascadeOnDelete();
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
        Schema::dropIfExists('block_order');
    }
};
