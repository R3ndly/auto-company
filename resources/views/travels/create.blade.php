@extends('layouts.app')

@section('content')
<h1>Добавление</h1>

<form action="{{ route('travels.store') }}" method="POST">
    @csrf

    <div>
        <label for="Destination">Пункт назначения:</label>
        <input type="text" name="Destination" id="Destination" required>
    </div>

    <div>
        <label for="Distance_km">Расстояник, км:</label>
        <input type="number" name="Distance_km" id="Distance_km" required>
    </div>

    <button type="submit">Сохранить</button>
</form>

@endsection
