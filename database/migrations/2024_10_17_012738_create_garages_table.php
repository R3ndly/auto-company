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
        Schema::create('garages', function (Blueprint $table) {
            $table->bigIncrements('Car_code'); 
            $table->string('Type_failure');
            $table->string('Type_of_spare_part');
            $table->integer('Spare_part_price');
            $table->date('Repair_start_date');
            $table->date('Repair_end_date');

            $table->foreign('Car_code')->references('Car_code')->on('cars')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garages');
    }
};
