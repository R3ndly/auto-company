@extends('layouts.app')

@section('content')
<h1>Добавление</h1>

<form action="{{ route('drivers.store') }}" method="POST">
    @csrf

    <div>
        <label for="Name">ФИО водителя:</label>
        <input type="text" name="Name" id="Name" required>
    </div>

    <div>
        <label for="Experience">Стаж:</label>
        <input type="number" name="Experience" id="Experience" required>
    </div>

    <div>
        <label for="Number_passport">№ паспорта:</label>
        <input type="number" name="Number_passport" id="Number_passport" required>
    </div>

    <div>
        <label for="Place_residence">Место прописки:</label>
        <input type="text" name="Place_residence" id="Place_residence" required>
    </div>

    <div>
        <label for="Phone">Телефон:</label>
        <input type="text" name="Phone" id="Phone" require>
    </div>

    <button type="submit">Сохранить</button>
</form>

@endsection
