@extends('layouts.app')

@section('content')
<h1>Добавить студента</h1>

<form action="{{ route('students.store') }}" method="POST">
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
        <label for="group">Группа:</label>
        <input type="text" name="group" id="group">
    </div>

    <div>
        <label for="average_score">Средний балл:</label>
        <input type="number" step="0.01" name="average_score" id="average_score">
    </div>

    <button type="submit">Сохранить</button>
</form>

@endsection
