<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // VARCHAR(255)
            // $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('city_id');
            $table->foreign('city_id')->on('cities')->references('id');
            // $table->foreignId('owner_id');
            // $table->foreign('owner_id')->on('owners')->references('id');
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
        Schema::dropIfExists('stores');
    }
}
