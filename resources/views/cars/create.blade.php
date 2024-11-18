@extends('layouts.app')

@section('content')
<h1>Добавление гаража</h1>

<form action="{{ route('garages.store') }}" method="POST">
    @csrf

    <div>
        <label for="Type_failure">Тип поломки:</label>
        <input type="text" name="Type_failure" id="Type_failure" required>
    </div>

    <div>
        <label for="Type_of_spare_part">Вид запчасти:</label>
        <input type="text" name="Type_of_spare_part" id="Type_of_spare_part" required>
    </div>

    <div>
        <label for="Spare_part_price">Цена запчасти:</label>
        <input type="number" name="Spare_part_price" id="Spare_part_price" required>
    </div>

    <div>
        <label for="Repair_start_date">Дата начала ремонта:</label>
        <input type="date" name="Repair_start_date" id="Repair_start_date" required>
    </div>

    <div>
        <label for="Repair_end_date">Дата конца реманта:</label>
        <input type="date" name="Repair_end_date" id="Repair_end_date" require>
    </div>

    <button type="submit">Сохранить</button>
</form>

@endsection
