@extends('layouts.app')

@section('content')
<h1>Список машин</h1>
<a href="{{ route('cars.create') }}">Добавить гараж</a>
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
            <th>Регистрационный номер</th>
            <th>Название авто</th>
            <th>Год выпуска авто</th>
            <th>Пробег</th>
            <th>Категория</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cars as $car)
            <tr>
                <td>{{ $car->Registration_number }}</td>
                <td>{{ $car->Car_name }}</td>
                <td>{{ $car->Year_manufacture_car }}</td>
                <td>{{ $car->Mileage }}</td>
                <td>{{ $car->Category }}</td>
                <td>
                    <a href="{{ route('cars.edit', $car) }}">Редактировать</a>

                    <form action="{{ route('cars.destroy', $car) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $cars->links() }} <!-- Пагинация -->
@endsection
