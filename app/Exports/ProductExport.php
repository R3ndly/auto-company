<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    public function collection()
    {
        return Product::select('Product_code', 'Name_product', 'Amount_product', 'Price_product')->get();
    }
}
