@extends('layouts.app')

@section('content')
<h1>Редактировать преподавателя</h1>

<form action="{{ route('prepods.update', $prepod) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $prepod->name) }}" required>
    </div>

    <div>
        <label for="surname">Фамилия:</label>
        <input type="text" name="surname" id="surname" value="{{ old('surname', $prepod->surname) }}" required>
    </div>

    <div>
        <label for="patronymic">Отчество:</label>
        <input type="text" name="patronymic" id="patronymic" value="{{ old('patronymic', $prepod->patronymic) }}">
    </div>

    <div>
        <label for="age">Возраст:</label>
        <input type="number" name="age" id="age" value="{{ old('age', $prepod->age) }}" required min="0">
    </div>

    <div>
        <label for="phone">Телефон:</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $prepod->phone) }}">
    </div>

    <div>
        <label for="salary">Зарплата:</label>
        <input type="number" step="0.01" name="salary" id="salary"
               value="{{ old('salary', $prepod->salary) }}">
    </div>

    <div>
        <label for="experience">Стаж:</label>
        <input type="text" name="experience" id="experience"
               value="{{ old('experience', $prepod->experience) }}">
    </div>

    <button type="submit">Обновить</button>
</form>

@endsection
