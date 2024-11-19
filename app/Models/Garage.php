<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    protected $table = 'garages';
    protected $primaryKey = 'Car_code';
    public $timestamps = false;
    protected $fillable = [
        'Car_code',
        'Type_failure',
        'Type_of_spare_part',
        'Spare_part_price',
        'Repair_start_date',
        'Repair_end_date',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'Car_code', 'Car_code');
    }
}
