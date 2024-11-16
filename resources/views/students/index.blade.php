@extends('layouts.app')

@section('content')
<h1>Список студентов</h1>
<a href="{{ route('students.create') }}">Добавить студента</a>
<button>
    <a href="/student/export">Дамб В Excel</a>
</button>
<button>
    <a href="/student/exportTXT">Дамб В txt</a>
</button>
<button>
    <a href="/student/exportCSV">Дамб В CSV</a>
</button>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th>Возраст</th>
            <th>Телефон</th>
            <th>Группа</th>
            <th>Средний балл</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->surname }}</td>
                <td>{{ $student->patronymic }}</td>
                <td>{{ $student->age }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->group }}</td>
                <td>{{ $student->average_score }}</td>
                <td>
                    <a href="{{ route('students.edit', $student) }}">Редактировать</a>

                    <!-- Форма для удаления студента -->
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $students->links() }} <!-- Пагинация -->
@endsection
