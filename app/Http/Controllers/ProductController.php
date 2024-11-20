<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
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
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function exportTXT()
    {
        $filed = "products.txt";
        $rows = (new ProductExport())->collection();
        file_put_contents($filed, $rows);
    }

    public function exportCSV()
    {
       return Excel::download(new ProductExport, 'products.csv');
    } 

    public function exportXML()
    {
    $fileName = 'products.xml';
    $rows = (new ProductExport())->collection();

    $xmlContent = new \SimpleXMLElement('<products/>');

    foreach ($rows as $row) {
        $product = $xmlContent->addChild('product');
        $product->addChild('Product_code', $row->Product_code);
        $product->addChild('Name_product', $row->Name_product);
        $product->addChild('Amount_product', $row->Amount_product);
        $product->addChild('Price_product', $row->Price_product);
    }

    return response($xmlContent->asXML(), 200)
        ->header('Content-Type', 'application/xml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function exportYAML()
{
    $fileName = 'products.yaml';
    $rows = (new ProductExport())->collection();

    $data = [];
    foreach ($rows as $row) {
        $data[] = [
            'Product_code' => $row->Product_code,
            'Name_product' => $row->Name_product,
            'Amount_product' => $row->Amount_product,
            'Price_product' => $row->Price_product,
        ];
    }

    $yamlContent = \Symfony\Component\Yaml\Yaml::dump($data);

    return response($yamlContent, 200)
        ->header('Content-Type', 'application/x-yaml')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
}

}
