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
        Schema::create('food_use', function (Blueprint $table) {
            $table->id();
            $table->double('quantity',8)->nullable()->default(1);
            $table->unsignedBigInteger('use_id');
            $table->unsignedBigInteger('food_id');
            $table->foreign('use_id')->references('id')->on('uses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('food_id')->references('id')->on('foods')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('food_use');
    }
};
