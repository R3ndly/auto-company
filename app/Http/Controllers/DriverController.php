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

    public function exportXML()
    {
    $fileName = 'drivers.xml';
    $rows = (new DriverExport())->collection();

    $xmlContent = new \SimpleXMLElement('<drivers/>');

    foreach ($rows as $row) {
        $driver = $xmlContent->addChild('driver');
        $driver->addChild('Driver_code', $row->Driver_code);
        $driver->addChild('Name', $row->Name);
        $driver->addChild('Experience', $row->Experience);
        $driver->addChild('Number_passport', $row->Number_passport);
        $driver->addChild('Place_residence', $row->Place_residence);
        $driver->addChild('Phone', $row->Phone);
    }

    return response($xmlContent->asXML(), 200)
        ->header('Content-Type', 'application/xml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function exportYAML()
{
    $fileName = 'drivers.yaml';
    $rows = (new DriverExport())->collection();

    $data = [];
    foreach ($rows as $row) {
        $data[] = [
            'Driver_code' => $row->Driver_code,
            'Name' => $row->Name,
            'Experience' => $row->Experience,
            'Number_passport' => $row->Number_passport,
            'Place_residence' => $row->Place_residence,
            'Phone' => $row->Phone,
        ];
    }

    $yamlContent = \Symfony\Component\Yaml\Yaml::dump($data);

    return response($yamlContent, 200)
        ->header('Content-Type', 'application/x-yaml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
}

}
