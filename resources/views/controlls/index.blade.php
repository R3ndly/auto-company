@extends('layouts.app')

@section('content')
<h1>Список</h1>
<a href="{{ route('controlls.create') }}">Добавить</a>
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
            <th>Время прибытия</th>
            <th>Время отбытия</th>
            <th>Код водителя</th>
            <th>Путёвка</th>
            <th>Товар</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($controlls as $controll)
            <tr>
                <td>{{ $controll->Arrival_time }}</td>
                <td>{{ $controll->Departure_time }}</td>
                <td>{{ $controll->Driver_code }}</td>
                <td>{{ $controll->Travel_code }}</td>
                <td>{{ $controll->Product_code }}</td>
                <td>
                    <a href="{{ route('controlls.edit', $controll) }}">Редактировать</a>

                    <form action="{{ route('controlls.destroy', $controll) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $controlls->links() }} <!-- Пагинация -->
@endsection
