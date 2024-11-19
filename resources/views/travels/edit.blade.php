@extends('layouts.app')

@section('content')
<h1>Редактировать</h1>


<form action="{{ route('travels.update', $travel) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="Destination">Пункт назначения:</label>
        <input type="text" name="Destination" id="Destination" value="{{ old('Destination', $travel->Destination) }}"  required>
    </div>

    <div>
        <label for="Distance_km">Расстояник, км:</label>
        <input type="number" name="Distance_km" id="Distance_km" value="{{ old('Distance_km', $travel->Distance_km) }}"  required>
    </div>

    <button type="submit">Обновить</button>
</form>

@endsection
