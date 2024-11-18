<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name_product' => 'required',
            'Amount_product' => 'required',
            'Price_product' => 'required',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Гараж успешно добавлен.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'Name_product' => 'required',
            'Amount_product' => 'required',
            'Price_product' => 'required',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Гараж успешно обновлён.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Гараж успешно удалён.');
    }

    public function exportExcel() 
    {
        return Excel::download(new StudentExport, 'products.xlsx');
    }

    public function exportTXT()
    {
        $filed = "products.txt";
        $rows = (new StudentExport())->collection();
        file_put_contents($filed, $rows);
    }

    public function exportCSV()
    {
       return Excel::download(new StudentExport, 'products.csv');
    } 

}
