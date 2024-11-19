<?php

namespace App\Exports;

use App\Models\Driver;
use Maatwebsite\Excel\Concerns\FromCollection;

class DriverExport implements FromCollection
{
    public function collection()
    {
        return Driver::select('Driver_code, Name, Experience, Number_passport, Place_residence, Phone')->get();
    }
}
