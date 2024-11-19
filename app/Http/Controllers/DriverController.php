<?php
namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Exports\DriverExport;
use Maatwebsite\Excel\Facades\Excel;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::paginate(10);
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Experience' => 'required',
            'Number_passport' => 'required',
            'Place_residence' => 'required',
            'Phone' => 'required',
        ]);

        Driver::create($request->all());
        return redirect()->route('drivers.index')->with('success', 'Гараж успешно добавлен.');
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'Type_failure' => 'required',
            'Type_of_spare_part' => 'required',
            'Spare_part_price' => 'required',
            'Repair_start_date' => 'required',
            'Repair_end_date' => 'required',
        ]);

        $driver->update($request->all());
        return redirect()->route('drivers.index')->with('success', 'Гараж успешно обновлён.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Гараж успешно удалён.');
    }

    public function exportExcel() 
    {
        return Excel::download(new DriverExport, 'drivers.xlsx');
    }

    public function exportTXT()
    {
        $filed = "drivers.txt";
        $rows = (new DriverExport())->collection();
        file_put_contents($filed, $rows);
    }

    public function exportCSV()
    {
       return Excel::download(new DriverExport, 'drivers.csv');
    } 

}
