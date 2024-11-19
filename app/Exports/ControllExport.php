<?php

namespace App\Exports;

use App\Models\Controll;
use Maatwebsite\Excel\Concerns\FromCollection;

class ControllExport implements FromCollection
{
    public function collection()
    {
        return Controll::select('Car_code, Arrival_time, Departure_time, Driver_code, Travel_code, Product_code')->get();
    }
}
