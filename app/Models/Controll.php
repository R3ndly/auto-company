<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Controll extends Model
{
    protected $table = 'controlls';
    protected $primaryKey = 'Car_code';
    public $timestamps = false;
    protected $fillable = [
        'Car_code',
        'Arrival_time',
        'Departure_time',
        'Driver_code',
        'Travel_code',
        'Product_code',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'Driver_code', 'Driver_code');
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'Product_code', 'Product_code');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_code', 'Product_code');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'Car_code', 'Car_code');
    }
}
