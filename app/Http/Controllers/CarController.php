<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::paginate(10);
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Registration_number' => 'required',
            'Car_name' => 'required',
            'Year_manufacture_car' => 'required',
            'Mileage' => 'required',
            'Category' => 'required',
        ]);

        Car::create($request->all());
        return redirect()->route('cars.index')->with('success', 'Машина успешно добавлена.');
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'Registration_number' => 'required',
            'Car_name' => 'required',
            'Year_manufacture_car' => 'required',
            'Mileage' => 'required',
            'Category' => 'required',
        ]);

        $car->update($request->all());
        return redirect()->route('cars.index')->with('success', 'Машина успешно обновлёна.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Машина успешно удалёнa.');
    }

    public function exportExcel() 
    {
        return Excel::download(new StudentExport, 'students.xlsx');
    }

    public function exportTXT()
    {
        $filed = "save.txt";
        $rows = (new StudentExport())->collection();
        file_put_contents($filed, $rows);
    }

    public function exportCSV()
    {
       return Excel::download(new StudentExport, 'cars.csv');
    } 

}
