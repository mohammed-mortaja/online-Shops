<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            // $table->string('name');
            // $table->string('mobile');
            // $table->string('image')->nullable();
            // $table->string('address')->nullable();
            // $table->enum('gender', ['male', 'female']);
            // $table->foreignId('city_id');
            // $table->foreign('city_id')->on('cities')->references('id');
            // $table->morphs('actor');
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
}
