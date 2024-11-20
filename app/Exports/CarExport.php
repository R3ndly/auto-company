<?php

namespace App\Exports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\FromCollection;

class CarExport implements FromCollection
{
    public function collection()
    {
        return Car::select('Car_code', 'Registration_number', 'Car_name', 'Year_manufacture_car', 'Mileage', 'Category')->get();
    }
}
