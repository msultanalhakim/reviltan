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
        Schema::create('histories', function (Blueprint $table) {
            $table->id('history_id');
            $table->string('reference_number');
            $table->text('description');
            $table->string('total');
            $table->enum('payment_method',['Cash','Credit Card','Bank Transfer']);
            $table->enum('payment_status',['Failed','Pending','Paid'])->default('Paid');
            $table->enum('service_status',['Failed','Pending','Completed'])->default('Completed');
            $table->unsignedBigInteger('operator_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicles');
            $table->foreign('booking_id')->references('booking_id')->on('bookings');
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
