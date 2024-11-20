<?php
namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Exports\TravelExport;
use Maatwebsite\Excel\Facades\Excel;

class TravelController extends Controller
{
    public function index()
    {
        $travels = Travel::paginate(10);
        return view('travels.index', compact('travels'));
    }

    public function create()
    {
        return view('travels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Destination' => 'required',
            'Distance_km' => 'required',
        ]);

        Travel::create($request->all());
        return redirect()->route('travels.index')->with('success', 'Гараж успешно добавлен.');
    }

    public function edit(Travel $travel)
    {
        return view('travels.edit', compact('travel'));
    }

    public function update(Request $request, Travel $travel)
    {
        $request->validate([
            'Destination' => 'required',
            'Distance_km' => 'required',
        ]);

        $travel->update($request->all());
        return redirect()->route('travels.index')->with('success', 'Гараж успешно обновлён.');
    }

    public function destroy(Travel $travel)
    {
        $travel->delete();
        return redirect()->route('travels.index')->with('success', 'Гараж успешно удалён.');
    }

    public function exportExcel() 
    {
        return Excel::download(new TravelExport, 'travels.xlsx');
    }

    public function exportTXT()
    {
        $filed = "travels.txt";
        $rows = (new TravelExport())->collection();
        file_put_contents($filed, $rows);
    }

    public function exportCSV()
    {
       return Excel::download(new TravelExport, 'travels.csv');
    } 

    public function exportXML()
    {
    $fileName = 'travels.xml';
    $rows = (new TravelExport())->collection();

    $xmlContent = new \SimpleXMLElement('<travels/>');

    foreach ($rows as $row) {
        $travel = $xmlContent->addChild('travel');
        $travel->addChild('Travel_code', $row->Travel_code);
        $travel->addChild('Destination', $row->Destination);
        $travel->addChild('Distance_km', $row->Distance_km);
    }

    return response($xmlContent->asXML(), 200)
        ->header('Content-Type', 'application/xml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function exportYAML()
{
    $fileName = 'travels.yaml';
    $rows = (new TravelExport())->collection();

    $data = [];
    foreach ($rows as $row) {
        $data[] = [
            'Travel_code' => $row->Travel_code,
            'Destination' => $row->Destination,
            'Distance_km' => $row->Distance_km,
        ];
    }

    $yamlContent = \Symfony\Component\Yaml\Yaml::dump($data);

    return response($yamlContent, 200)
        ->header('Content-Type', 'application/x-yaml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
}

}
