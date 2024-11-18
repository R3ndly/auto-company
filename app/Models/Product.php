<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'Product_code',
        'Name_product',
        'Amount_product',
        'Price_product',
    ];

    public function controll()
    {
        return $this->hasMany(Controll::class, 'Product_code', 'Product_code');
    }
}
