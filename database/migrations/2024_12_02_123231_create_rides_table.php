<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('from');
            $table->string('to');
            $table->bigInteger('transport_id')->unsigned();
            $table->bigInteger('car_id')->unsigned()->nullable();
            $table->bigInteger('bike_id')->unsigned()->nullable();
            $table->bigInteger('cycle_id')->unsigned()->nullable();
            $table->bigInteger('taxi_id')->unsigned()->nullable();
            $table->string('when');
            $table->date('date');
            $table->string('time');
            $table->float('value');
            $table->string('payment_way');
            $table->string('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('transport_id')->references('id')->on('transports')->onDelete('cascade');             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
