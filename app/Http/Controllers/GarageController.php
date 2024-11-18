<?php
namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

class GarageController extends Controller
{
    public function index()
    {
        $garages = Garage::paginate(10);
        return view('garages.index', compact('garages'));
    }

    public function create()
    {
        return view('garages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Type_failure' => 'required',
            'Type_of_spare_part' => 'required',
            'Spare_part_price' => 'required',
            'Repair_start_date' => 'required',
            'Repair_end_date' => 'required',
        ]);

        Garage::create($request->all());
        return redirect()->route('garages.index')->with('success', 'Гараж успешно добавлен.');
    }

    public function edit(Garage $garage)
    {
        return view('garages.edit', compact('garage'));
    }

    public function update(Request $request, Garage $garage)
    {
        $request->validate([
            'Type_failure' => 'required',
            'Type_of_spare_part' => 'required',
            'Spare_part_price' => 'required',
            'Repair_start_date' => 'required',
            'Repair_end_date' => 'required',
        ]);

        $garage->update($request->all());
        return redirect()->route('garages.index')->with('success', 'Гараж успешно обновлён.');
    }

    public function destroy(Garage $garage)
    {
        $garage->delete();
        return redirect()->route('garages.index')->with('success', 'Гараж успешно удалён.');
    }

    public function exportExcel() 
    {
        return Excel::download(new StudentExport, 'garages.xlsx');
    }

    public function exportTXT()
    {
        $filed = "save.txt";
        $rows = (new StudentExport())->collection();
        file_put_contents($filed, $rows);
    }

    public function exportCSV()
    {
       return Excel::download(new StudentExport, 'garages.csv');
    } 

}
