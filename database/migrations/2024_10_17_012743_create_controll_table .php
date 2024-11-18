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
        Schema::create('controlls', function (Blueprint $table) {
            $table->id("Car_code");
            $table->string('Arrival_time');
            $table->string('Departure_time');
            $table->unsignedBigInteger('Driver_code');
            $table->unsignedBigInteger('Travel_code');
            $table->unsignedBigInteger('Product_code');

            $table->foreign('Driver_code')->references('Driver_code')->on('drivers')->onDelete('cascade');
            $table->foreign('Travel_code')->references('Travel_code')->on('travels')->onDelete('cascade');
            $table->foreign('Product_code')->references('Product_code')->on('products')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controlls');
    }
};
