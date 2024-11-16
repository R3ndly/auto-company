<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'age' => 'required|integer',
            'phone' => 'nullable|string|max:15',
            'group' => 'nullable|string|max:50',
            'average_score' => 'nullable|numeric|min:0|max:100',
        ]);

        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Студент успешно добавлен.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            // другие валидации
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Студент успешно обновлён.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Студент успешно удалён.');
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
       return Excel::download(new StudentExport, 'students.csv');
    } 

}
