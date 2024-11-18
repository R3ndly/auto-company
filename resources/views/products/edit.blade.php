@extends('layouts.app')

@section('content')
<h1>Редактировать</h1>

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="Name_product">Наименование товара:</label>
        <input type="text" name="Name_product" id="Name_product" value="{{ old('Name_product', $products->Name_product) }}"  required>
    </div>

    <div>
        <label for="Amount_product">Кол-во товара:</label>
        <input type="number" name="Amount_product" id="Amount_product" value="{{ old('Amount_product', $products->Amount_product) }}"  required>
    </div>

    <div>
        <label for="Price_product">Цена товара:</label>
        <input type="number" name="Price_product" id="Price_product" value="{{ old('Price_product', $products->Price_product) }}"  required>
    </div>

    <button type="submit">Обновить</button>
</form>

@endsection
