<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Exports\CarExport;
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
        return Excel::download(new CarExport, 'cars.xlsx');
    }

    public function exportTXT()
    {
        $filed = "cars.txt";
        $rows = (new CarExport())->collection();
        file_put_contents($filed, $rows);
    }

    public function exportCSV()
    {
       return Excel::download(new CarExport, 'cars.csv');
    } 

    public function exportXML()
    {
    $fileName = 'cars.xml';
    $rows = (new CarExport())->collection();

    $xmlContent = new \SimpleXMLElement('<garages/>');

    foreach ($rows as $row) {
        $garage = $xmlContent->addChild('garage');
        $garage->addChild('Car_code', $row->Car_code);
        $garage->addChild('Type_failure', $row->Type_failure);
        $garage->addChild('Type_of_spare_part', $row->Type_of_spare_part);
        $garage->addChild('Spare_part_price', $row->Spare_part_price);
        $garage->addChild('Repair_start_date', $row->Repair_start_date);
        $garage->addChild('Repair_end_date', $row->Repair_end_date);
    }

    return response($xmlContent->asXML(), 200)
        ->header('Content-Type', 'application/xml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function exportYAML()
{
    $fileName = 'garages.yaml';
    $rows = (new GarageExport())->collection();

    $data = [];
    foreach ($rows as $row) {
        $data[] = [
            'Car_code' => $row->Car_code,
            'Type_failure' => $row->Type_failure,
            'Type_of_spare_part' => $row->Type_of_spare_part,
            'Spare_part_price' => $row->Spare_part_price,
            'Repair_start_date' => $row->Repair_start_date,
            'Repair_end_date' => $row->Repair_end_date,
        ];
    }

    $yamlContent = \Symfony\Component\Yaml\Yaml::dump($data);

    return response($yamlContent, 200)
        ->header('Content-Type', 'application/x-yaml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
}

}
