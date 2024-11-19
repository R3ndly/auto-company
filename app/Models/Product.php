<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'Product_code';
    public $timestamps = false;
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
