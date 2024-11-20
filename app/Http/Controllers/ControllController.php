<?php
namespace App\Http\Controllers;

use App\Models\Controll;
use Illuminate\Http\Request;
use App\Exports\ControllExport;
use Maatwebsite\Excel\Facades\Excel;

class ControllController extends Controller
{
    public function index()
    {
        $controlls = Controll::paginate(10);
        return view('controlls.index', compact('controlls'));
    }

    public function create()
    {
        return view('controlls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Arrival_time' => 'required',
            'Departure_time' => 'required',
            'Driver_code' => 'required',
            'Travel_code' => 'required',
            'Product_code' => 'required',
        ]);

        Controll::create($request->all());
        return redirect()->route('controlls.index')->with('success', ' успешно добавлен.');
    }

    public function edit(Controll $controll)
    {
        return view('controlls.edit', compact('controll'));
    }

    public function update(Request $request, Controll $controll)
    {
        $request->validate([
            'Arrival_time' => 'required',
            'Departure_time' => 'required',
            'Driver_code' => 'required',
            'Travel_code' => 'required',
            'Product_code' => 'required',
        ]);

        $controll->update($request->all());
        return redirect()->route('controlls.index')->with('success', ' успешно обновлён.');
    }

    public function destroy(Controll $controll)
    {
        $controll->delete();
        return redirect()->route('controlls.index')->with('success', 'Гараж успешно удалён.');
    }

    public function exportExcel() 
    {
        return Excel::download(new ControllExport, 'controlls.xlsx');
    }

    public function exportTXT()
    {
        $filed = "controlls.txt";
        $rows = (new ControllExport())->collection();
        file_put_contents($filed, $rows);
    }

    public function exportCSV()
    {
       return Excel::download(new ControllExport, 'controlls.csv');
    } 

    public function exportXML()
    {
    $fileName = 'controlls.xml';
    $rows = (new ControllExport())->collection();

    $xmlContent = new \SimpleXMLElement('<controlls/>');

    foreach ($rows as $row) {
        $controll = $xmlContent->addChild('controll');
        $controll->addChild('Car_code', $row->Car_code);
        $controll->addChild('Arrival_time', $row->Arrival_time);
        $controll->addChild('Departure_time', $row->Departure_time);
        $controll->addChild('Driver_code', $row->Driver_code);
        $controll->addChild('Travel_code', $row->Travel_code);
        $controll->addChild('Product_code', $row->Product_code);
    }

    return response($xmlContent->asXML(), 200)
        ->header('Content-Type', 'application/xml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function exportYAML()
{
    $fileName = 'controlls.yaml';
    $rows = (new ControllExport())->collection();

    $data = [];
    foreach ($rows as $row) {
        $data[] = [
            'Car_code' => $row->Car_code,
            'Arrival_time' => $row->Arrival_time,
            'Departure_time' => $row->Departure_time,
            'Driver_code' => $row->Driver_code,
            'Travel_code' => $row->Travel_code,
            'Product_code' => $row->Product_code,
        ];
    }

    $yamlContent = \Symfony\Component\Yaml\Yaml::dump($data);

    return response($yamlContent, 200)
        ->header('Content-Type', 'application/x-yaml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
}

}
