@extends('layouts.app')

@section('content')
<h1>Добавить преподавателя</h1>

<form action="{{ route('prepods.store') }}" method="POST">
    @csrf

    <div>
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="surname">Фамилия:</label>
        <input type="text" name="surname" id="surname" required>
    </div>

    <div>
        <label for="patronymic">Отчество:</label>
        <input type="text" name="patronymic" id="patronymic">
    </div>

    <div>
        <label for="age">Возраст:</label>
        <input type="number" name="age" id="age" required min="0">
    </div>

    <div>
        <label for="phone">Телефон:</label>
        <input type="text" name="phone" id="phone">
    </div>

    <div>
        <label for="salary">Зарплата:</label>
        <input type="number" step="0.01" name="salary" id="salary">
    </div>

    <div>
        <label for="experience">Стаж:</label>
        <input type="text" name="experience" id="experience">
    </div>

    <button type="submit">Сохранить</button>
</form>

@endsection
