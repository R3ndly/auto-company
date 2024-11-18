<?php
namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
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
        return Excel::download(new StudentExport, 'travels.xlsx');
    }

    public function exportTXT()
    {
        $filed = "travels.txt";
        $rows = (new StudentExport())->collection();
        file_put_contents($filed, $rows);
    }

    public function exportCSV()
    {
       return Excel::download(new StudentExport, 'travels.csv');
    } 

}
