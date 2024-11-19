<?php

namespace App\Exports;

use App\Models\Garage;
use Maatwebsite\Excel\Concerns\FromCollection;

class GarageExport implements FromCollection
{
    public function collection()
{
    return Garage::select('Car_code', 'Type_failure', 'Type_of_spare_part', 'Spare_part_price', 'Repair_start_date', 'Repair_end_date')->get();
}
}
