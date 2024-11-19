<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travels';
    protected $primaryKey = 'Travel_code';
    public $timestamps = false;
    protected $fillable = [
        'Travel_code',
        'Destination',
        'Distance_km',
    ];

    public function controll()
    {
        return $this->hasMany(Controll::class, 'Travel_code', 'Travel_code');
    }
}
