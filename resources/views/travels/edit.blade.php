@extends('layouts.app')

@section('content')
<h1>Редактировать</h1>


<form action="{{ route('drivers.update', $driver) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="Name">ФИО водителя:</label>
        <input type="text" name="Name" id="Name" value="{{ old('Name', $driver->Name) }}"  required>
    </div>

    <div>
        <label for="Experience">Стаж:</label>
        <input type="number" name="Experience" id="Experience" value="{{ old('NaExperienceme', $driver->Experience) }}"  required>
    </div>

    <div>
        <label for="Number_passport">№ паспорта:</label>
        <input type="number" name="Number_passport" id="Number_passport" value="{{ old('Number_passport', $driver->Number_passport) }}"  required>
    </div>

    <div>
        <label for="Place_residence">Место прописки:</label>
        <input type="text" name="Place_residence" id="Place_residence" value="{{ old('Place_residence', $driver->Place_residence) }}"  required>
    </div>

    <div>
        <label for="Phone">Телефон:</label>
        <input type="text" name="Phone" id="Phone" value="{{ old('Phone', $driver->Phone) }}"  require>
    </div>

    <button type="submit">Обновить</button>
</form>

@endsection
