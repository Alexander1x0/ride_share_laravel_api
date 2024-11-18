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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transport_id')->unsigned();
            $table->foreign('transport_id')->references('id')->on('transports')->onDelete('cascade');
            $table->boolean('available')->nullable();
            $table->string('name')->nullable();
            $table->string('max_power')->nullable();
            $table->string('fuel')->nullable();
            $table->string('max_speed')->nullable();
            $table->string('model')->nullable();
            $table->string('capacity')->nullable();
            $table->string('color')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('gear_type')->nullable();
            $table->float('rate')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
