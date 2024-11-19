@extends('layouts.app')

@section('content')
<h1>Список</h1>
<a href="{{ route('products.create') }}">Добавить</a>
<button>
    <a href="/product/export">Дамб В Excel</a>
</button>
<button>
    <a href="/product/exportTXT">Дамб В txt</a>
</button>
<button>
    <a href="/product/exportCSV">Дамб В CSV</a>
</button>
<button>
    <a href="/product/exportXML">Дамб В XML</a>
</button>
<button>
    <a href="/product/exportYAML">Дамб В Yaml</a>
</button>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Наименование товара</th>
            <th>Кол-во товара</th>
            <th>Цена товара</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->Name_product }}</td>
                <td>{{ $product->Amount_product }}</td>
                <td>{{ $product->Price_product }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}">Редактировать</a>

                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $products->links() }} <!-- Пагинация -->
@endsection
