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
            $table->text('description');
            $table->string('total');
            $table->enum('payment_method',['Cash','Credit Card','Bank Transfer']);
            $table->enum('payment_status',['Failed','Pending','Paid'])->default('Pending');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('booking_id');
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
