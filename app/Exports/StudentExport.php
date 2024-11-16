<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentExport implements FromCollection
{
    public function collection()
    {
        return Student::select(\DB::raw('id, name, surname, patronymic, age, phone, "group", average_score'))->get();
    }
}
