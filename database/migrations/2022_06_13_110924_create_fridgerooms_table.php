<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fridgerooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')
                  ->references('id')
                  ->on('locations')
                  ->cascadeOnDelete();
            $table->tinyInteger('temp');
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
        Schema::dropIfExists('fridgerooms');
    }
};
