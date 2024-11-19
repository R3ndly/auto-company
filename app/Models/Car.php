<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'Car_code';
    public $timestamps = false;
    protected $fillable = [
        'Car_code',
        'Registration_number',
        'Car_name',
        'Year_manufacture_car',
        'Mileage',
        'Category',
    ];

    public function garages()
    {
        return $this->hasMany(Garage::class, 'Car_code', 'Car_code');
    }

    public function controll()
    {
        return $this->hasMany(Controll::class, 'Car_code', 'Car_code');
    }
}
