<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    protected $table = 'garages';
    protected $fillable = [
        'Type_failure',
        'Type_of_spare_part',
        'Spare_part_price',
        'Repair_start_date',
        'Repair_end_date',
    ];
}
