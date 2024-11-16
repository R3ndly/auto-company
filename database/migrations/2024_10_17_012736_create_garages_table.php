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
            $table->id("Car_code");
            $table->string('Type_failure');
            $table->string('Type_of_spare_part');
            $table->integer('Spare_part_price');
            $table->date('Repair_start_date');
            $table->date('Repair_end_date');
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
