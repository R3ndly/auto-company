@extends('layouts.app')

@section('content')
<h1>Список преподавателей</h1>
<a href="{{ route('prepods.create') }}">Добавить преподавателя</a>

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
            <th>Зарплата</th>
            <th>Стаж</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($prepods as $prepod)
            <tr>
                <td>{{ $prepod->name }}</td>
                <td>{{ $prepod->surname }}</td>
                <td>{{ $prepod->patronymic }}</td>
                <td>{{ $prepod->age }}</td>
                <td>{{ $prepod->phone }}</td>
                <td>{{ $prepod->salary }}</td>
                <td>{{ $prepod->experience }}</td>
                <td>
                    <a href="{{ route('prepods.edit', $prepod) }}">Редактировать</a>
                    <form action="{{ route('prepods.destroy', $prepod) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $prepods->links() }} <!-- Пагинация -->
@endsection
