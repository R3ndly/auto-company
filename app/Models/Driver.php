<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    protected $fillable = [
        'Driver_code',
        'Name',
        'Experience',
        'Number_passport',
        'Place_residence',
        'Phone',
    ];

    public function controll()
    {
        return $this->hasMany(Controll::class, 'Driver_code', 'Driver_code');
    }
}
