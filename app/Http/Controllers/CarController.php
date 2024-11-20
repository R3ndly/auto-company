<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Exports\CarExport;
use App\Imports\CarsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Yaml\Exception\ParseException;



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
        $fileName = "cars.txt";
        $rows = (new CarExport())->collection();
        
        // Форматируем данные
        $content = '';
        foreach ($rows as $row) {
            $content .= implode("\t", [
                $row->Car_code,
                $row->Registration_number,
                $row->Car_name,
                $row->Year_manufacture_car,
                $row->Mileage,
                $row->Category,
            ]) . PHP_EOL;
        }

        // Возвращаем файл для загрузки
        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function exportCSV()
    {
       return Excel::download(new CarExport, 'cars.csv');
    } 

    public function exportXML()
{
    $fileName = 'cars.xml';
    $rows = (new CarExport())->collection();

    $xmlContent = new \SimpleXMLElement('<cars/>');

    foreach ($rows as $row) {
        $car = $xmlContent->addChild('car');
        $car->addChild('Car_code', $row->Car_code);
        $car->addChild('Registration_number', $row->Registration_number);
        $car->addChild('Car_name', $row->Car_name);
        $car->addChild('Year_manufacture_car', $row->Year_manufacture_car);
        $car->addChild('Mileage', $row->Mileage);
        $car->addChild('Category', $row->Category);
    }

    return response($xmlContent->asXML(), 200)
        ->header('Content-Type', 'application/xml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function exportYAML()
{
    $fileName = 'cars.yaml';
    $rows = (new CarExport())->collection();

    $data = [];
    foreach ($rows as $row) {
        $data[] = [
            'Car_code' => $row->Car_code,
            'Registration_number' => $row->Registration_number,
            'Car_name' => $row->Car_name,
            'Year_manufacture_car' => $row->Year_manufacture_car,
            'Mileage' => $row->Mileage,
            'Category' => $row->Category,
        ];
    }

    $yamlContent = \Symfony\Component\Yaml\Yaml::dump($data);

    return response($yamlContent, 200)
        ->header('Content-Type', 'application/x-yaml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
}  


public function import(Request $request)
{
    Excel::import(new CarsImport, $request->file('file'));
    return redirect('/')->with('success', 'Данные успешно импортированы');
}

public function upload(Request $request)
{
    // Валидация входного файла
    $request->validate([
        'file' => 'required|file|mimes:xlsx,csv,txt,xml,yaml',
    ]);

    $file = $request->file('file');
    $extension = $file->getClientOriginalExtension();
    $data = []; // Инициализация переменной для данных

    switch ($extension) {
        case 'xlsx':
            // Импорт данных из Excel
            $data = Excel::toArray(new CarsImport, $file);
            if (empty($data) || !is_array($data)) {
                return back()->withErrors(['error' => 'Не удалось загрузить данные из файла .xlsx']);
            }
            $data = $data[0]; // Используем первый лист
            break;

        case 'csv':
            // Импорт данных из CSV
            $data = array_map('str_getcsv', file($file));
            break;

        case 'txt':
            // Импорт данных из TXT
            $data = array_map(function ($line) {
                return explode("\t", trim($line)); // Разделяем по табуляции
            }, file($file));
            break;

        case 'xml':
            // Импорт данных из XML
            try {
                $xmlData = simplexml_load_file($file);
                if ($xmlData === false) {
                    return back()->withErrors(['error' => 'Ошибка при загрузке XML файла']);
                }

                // Преобразование в массив
                $data = json_decode(json_encode($xmlData), true);

                // Проверяем, что мы получили массив "car"
                if (isset($data['car'])) {
                    $data = $data['car']; // Если корневой элемент - cars и каждый элемент - car
                } else {
                    return back()->withErrors(['error' => 'Не удалось загрузить данные из файла .xml']);
                }

                // Приводим данные к ожидаемому формату (массив массивов)
                if (!is_array($data)) {
                    $data = [$data]; // Оборачиваем в массив, если это один элемент
                }

                Log::info('Загруженные данные из XML:', ['data' => $data]); // Отладка

            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Ошибка при обработке XML: ' . $e->getMessage()]);
            }
            break;

        case 'yaml':
            // Импорт данных из YAML
            try {
                $data = Yaml::parseFile($file->getRealPath());
                if (empty($data)) {
                    return back()->withErrors(['error' => 'Не удалось загрузить данные из файла .yaml']);
                }

                Log::info('Загруженные данные из YAML:', ['data' => $data]); // Отладка

            } catch (ParseException $exception) {
                return back()->withErrors(['error' => 'Ошибка при разборе YAML файла: ' . $exception->getMessage()]);
            }
            break;

        default:
            return back()->withErrors(['error' => 'Неподдерживаемый формат файла']);
    }

    // Вставка данных в базу данных
    foreach ($data as $row) {
        // Проверяем наличие необходимых ключей для вставки в базу данных
        if ($extension === 'xml') {
            // Для XML используем ассоциативные ключи
            if (!isset($row['Registration_number'], $row['Car_name'], $row['Year_manufacture_car'], $row['Mileage'], $row['Category'])) {
                Log::warning('Пропущена строка: ', ['row' => $row]);
                continue; // Пропустить строку без необходимых данных
            }
        } elseif ($extension === 'yaml') {
            // Для YAML используем ассоциативные ключи
            if (!isset($row['Registration_number'], $row['Car_name'], $row['Year_manufacture_car'], $row['Mileage'], $row['Category'])) {
                Log::warning('Пропущена строка: ', ['row' => $row]);
                continue; // Пропустить строку без необходимых данных
            }
        } else {
            // Для других форматов используем индексы
            if (!isset($row[0], $row[1], $row[2], $row[3], $row[4])) {
                Log::warning('Пропущена строка: ', ['row' => $row]);
                continue; // Пропустить строку без необходимых данных
            }
        }

        try {
            DB::table('cars')->insert([
                'Registration_number' => ($extension === 'xml' || $extension === 'yaml') ? (string)$row['Registration_number'] : (string)$row[1],
                'Car_name' => ($extension === 'xml' || $extension === 'yaml') ? (string)$row['Car_name'] : (string)$row[2],
                'Year_manufacture_car' => ($extension === 'xml' || $extension === 'yaml') ? (int)$row['Year_manufacture_car'] : (int)$row[3],
                'Mileage' => ($extension === 'xml' || $extension === 'yaml') ? (int)$row['Mileage'] : (int)$row[4],
                'Category' => ($extension === 'xml' || $extension === 'yaml') ? (string)$row['Category'] : (string)$row[5],
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка при вставке данных: ' . $e->getMessage());
        }
    }

    return redirect()->back()->with('success', 'Данные успешно загружены');
}




}
