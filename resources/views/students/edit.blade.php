@extends('layouts.app')

@section('content')
<h1>Редактировать студента</h1>

<form action="{{ route('students.update', $student) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required>
    </div>

    <div>
        <label for="surname">Фамилия:</label>
        <input type="text" name="surname" id="surname" value="{{ old('surname', $student->surname) }}" required>
    </div>

    <div>
        <label for="patronymic">Отчество:</label>
        <input type="text" name="patronymic" id="patronymic" value="{{ old('patronymic', $student->patronymic) }}">
    </div>

    <div>
        <label for="age">Возраст:</label>
        <input type="number" name="age" id="age" value="{{ old('age', $student->age) }}" required min="0">
    </div>

    <div>
        <label for="phone">Телефон:</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $student->phone) }}">
    </div>

    <div>
        <label for="group">Группа:</label>
        <input type="text" name="group" id="group" value="{{ old('group', $student->group) }}">
    </div>

    <div>
        <label for="average_score">Средний балл:</label>
        <input type="number" step="0.01" name="average_score" id="average_score"
               value="{{ old('average_score', $student->average_score) }}">
    </div>

    <button type="submit">Обновить</button>
</form>

@endsection
