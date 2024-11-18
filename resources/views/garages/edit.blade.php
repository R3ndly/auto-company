@extends('layouts.app')

@section('content')
<h1>Редактировать гараж</h1>

<form action="{{ route('garages.update', $garage) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="Type_failure">Тип поломки:</label>
        <input type="text" name="Type_failure" id="Type_failure" value="{{ old('Type_failure', $garage->Type_failure) }}" required>
    </div>

    <div>
        <label for="Type_of_spare_part">Вид запчасти:</label>
        <input type="text" name="Type_of_spare_part" id="Type_of_spare_part" value="{{ old('Type_of_spare_part', $garage->Type_of_spare_part) }}" required>
    </div>

    <div>
        <label for="Spare_part_price">Цена запчасти:</label>
        <input type="number" name="Spare_part_price" id="Spare_part_price" value="{{ old('Spare_part_price', $garage->Spare_part_price) }}" required>
    </div>

    <div>
        <label for="Repair_start_date">Дата начала ремонта:</label>
        <input type="date" name="Repair_start_date" id="Repair_start_date" value="{{ old('age', $garage->age) }}" required>
    </div>

    <div>
    <label for="Repair_end_date">Дата конца реманта:</label>
    <input type="date" name="Repair_end_date" id="Repair_end_date" value="{{ old('Repair_end_date', $garage->Repair_end_date) }}" required>
    </div>

    <button type="submit">Обновить</button>
</form>

@endsection
