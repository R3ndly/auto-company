@extends('layouts.app')

@section('content')
<h1>Добавление</h1>

<form action="{{ route('cars.store') }}" method="POST">
    @csrf

    <div>
        <label for="Registration_number">Регистрационный номер:</label>
        <input type="text" name="Registration_number" id="Registration_number" required>
    </div>

    <div>
        <label for="Car_name">Название авто:</label>
        <input type="text" name="Car_name" id="Car_name" required>
    </div>

    <div>
        <label for="Year_manufacture_car">Год выпуска авто:</label>
        <input type="number" name="Year_manufacture_car" id="Year_manufacture_car" required>
    </div>

    <div>
        <label for="Mileage">Пробег:</label>
        <input type="number" name="Mileage" id="Mileage" required>
    </div>

    <div>
        <label for="Category">Категория:</label>
        <input type="text" name="Category" id="Category" require>
    </div>

    <button type="submit">Сохранить</button>
</form>

@endsection
