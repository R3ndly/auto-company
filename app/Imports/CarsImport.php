<?php

namespace App\Imports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\ToModel;

class CarsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Car([
            'Registration_number' => $row[0],
            'Car_name' => $row[1],
            'Year_manufacture_car' => $row[2],
            'Mileage' => $row[3],
            'Category' => $row[4],
        ]);
    }
}
