@extends('layouts.app')

@section('content')
<h1>Редактировать</h1>

<form action="{{ route('cars.update', $car) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="Registration_number">Регистрационный номер:</label>
        <input type="text" name="Registration_number" id="Registration_number" value="{{ old('Registration_number', $car->Registration_number) }}" required>
    </div>

    <div>
        <label for="Car_name">Название авто:</label>
        <input type="text" name="Car_name" id="Car_name" value="{{ old('Car_name', $car->Car_name) }}" required>
    </div>

    <div>
        <label for="Year_manufacture_car">Год выпуска авто:</label>
        <input type="number" name="Year_manufacture_car" id="Year_manufacture_car" value="{{ old('Year_manufacture_car', $car->Year_manufacture_car) }}" required>
    </div>

    <div>
        <label for="Mileage">Пробег:</label>
        <input type="number" name="Mileage" id="Mileage" value="{{ old('Mileage', $car->Mileage) }}" required>
    </div>

    <div>
        <label for="Category">Категория:</label>
        <input type="text" name="Category" id="Category" value="{{ old('Category', $car->Category) }}" required>
    </div>

    <button type="submit">Обновить</button>
</form>

@endsection
