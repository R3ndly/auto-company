<?php
namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;
use App\Exports\GarageExport;
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
        return Excel::download(new GarageExport, 'garages.xlsx');
    }

    public function exportTXT()
    {
        $fileName = 'garages.txt';
        $rows = (new GarageExport())->collection();

        // Форматируем данные
        $content = '';
        foreach ($rows as $row) {
            $content .= implode("\t", [
                $row->Car_code,
                $row->Type_failure,
                $row->Type_of_spare_part,
                $row->Spare_part_price,
                $row->Repair_start_date,
                $row->Repair_end_date,
            ]) . PHP_EOL;
        }

        // Возвращаем файл для загрузки
        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function exportCSV()
    {
       return Excel::download(new GarageExport, 'garages.csv');
    } 

    public function exportXML()
    {
    $fileName = 'garages.xml';
    $rows = (new GarageExport())->collection();

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
