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
        Schema::create('details', function (Blueprint $table) {
            $table->id('detail_id');
            $table->string('reference_number', 255);
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('item_id');
            
            $table->index('reference_number');

            $table->foreign('item_id')->references('item_id')->on('items');
            $table->foreign('reference_number')->references('reference_number')->on('transactions');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
