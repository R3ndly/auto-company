<?php
namespace App\Http\Controllers;

use App\Models\Prepod;
use Illuminate\Http\Request;

class PrepodController extends Controller
{
    public function index()
    {
        $prepods = Prepod::paginate(10);
        return view('prepods.index', compact('prepods'));
    }

    public function create()
    {
        return view('prepods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // другие валидации
        ]);

        Prepod::create($request->all());
        return redirect()->route('prepods.index')->with('success', 'Преподаватель успешно добавлен.');
    }

    public function edit(Prepod $prepod)
    {
        return view('prepods.edit', compact('prepod'));
    }

    public function update(Request $request, Prepod $prepod)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // другие валидации
        ]);

        $prepod->update($request->all());
        return redirect()->route('prepods.index')->with('success', 'Преподаватель успешно обновлён.');
    }

    public function destroy(Prepod $prepod)
    {
        $prepod->delete();
        return redirect()->route('prepods.index')->with('success', 'Преподаватель успешно удалён.');
    }
}
