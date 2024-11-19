<?php

namespace App\Exports;

use App\Models\Travel;
use Maatwebsite\Excel\Concerns\FromCollection;

class TravelExport implements FromCollection
{
    public function collection()
    {
        return Travel::select('Travel_code, Destination, Distance_km')->get();
    }
}
