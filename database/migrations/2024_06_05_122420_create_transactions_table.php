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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('reference_number');
            $table->text('description')->nullable();
            $table->string('total')->nullable();
            $table->enum('payment_method',['Cash','Credit Card','Bank Transfer'])->nullable();
            $table->enum('payment_status',['Failed','Pending','Paid'])->default('Pending');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicles');
            $table->foreign('booking_id')->references('booking_id')->on('bookings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
