@extends('layouts.app')

@section('content')
<h1>Добавление</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div>
        <label for="Name_product">Наименование товара:</label>
        <input type="text" name="Name_product" id="Name_product" required>
    </div>

    <div>
        <label for="Amount_product">Кол-во товара:</label>
        <input type="number" name="Amount_product" id="Amount_product"  required>
    </div>

    <div>
        <label for="Price_product">Цена товара:</label>
        <input type="number" name="Price_product" id="Price_product" required>
    </div>


    <button type="submit">Сохранить</button>
</form>

@endsection
