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
        Schema::create('paypal_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ride_id'); // Reference to the ride
            $table->unsignedBigInteger('user_id'); // Reference to the user
            $table->string('paypal_order_id')->nullable(); // PayPal Order ID
            $table->string('status')->default('PENDING'); // Payment status: PENDING, COMPLETED, CANCELED, FAILED
            $table->decimal('amount', 10, 2); // Payment amount
            $table->string('currency', 10)->default('USD'); // Currency
            $table->json('response')->nullable(); // Raw response from PayPal
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paypal_transactions');
    }
};
