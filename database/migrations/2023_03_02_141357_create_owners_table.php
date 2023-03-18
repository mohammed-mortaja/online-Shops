<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('mobile');
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->foreignId('city_id');
            $table->foreign('city_id')->on('cities')->references('id');
            // $table->float('payment_required');
            // $table->float('payment_paid');
            // $table->float('payment_not_Paid');
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
        Schema::dropIfExists('owners');
    }
}
