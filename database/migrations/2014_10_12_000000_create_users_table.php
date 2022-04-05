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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('avatar')->nullable();
            $table->unsignedTinyInteger('status')->nullable()->default(1);
            $table->unsignedTinyInteger('gender')->nullable()->comment('0 => is male , 1 => is female , null => is the rest');
            $table->unsignedTinyInteger('receive_email')->nullable()->default(0);
            $table->string('password');
            $table->string('country')->nullable();
            $table->date('birth_date')->nullable();
            $table->bigInteger('daily_use_target')->nullable();
            $table->double('height')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
