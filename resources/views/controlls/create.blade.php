@extends('layouts.app')

@section('content')
<h1>Добавление гаража</h1>

<form action="{{ route('garages.store') }}" method="POST">
    @csrf

    <div>
        <label for="Arrival_time">Время прибытия:</label>
        <input type="text" name="Arrival_time" id="Arrival_time" required>
    </div>

    <div>
        <label for="Departure_time">Время отбытия:</label>
        <input type="text" name="Departure_time" id="Departure_time" required>
    </div>

    <div>
        <label for="Driver_code">Код водителя:</label>
        <input type="number" name="Driver_code" id="Driver_code" required>
    </div>

    <div>
        <label for="Travel_code">Путёвка:</label>
        <input type="number" name="Travel_code" id="Travel_code" required>
    </div>

    <div>
    <label for="Product_code">Товар:</label>
    <input type="datnumbere" name="Product_code" id="Product_code" required>
    </div>

    <button type="submit">Сохранить</button>
</form>

@endsection
