@extends('layouts.app')

@section('content')
<h1>Список</h1>
<a href="{{ route('drivers.create') }}">Добавить</a>
<button>
    <a href="/driver/export">Дамб В Excel</a>
</button>
<button>
    <a href="/driver/exportTXT">Дамб В txt</a>
</button>
<button>
    <a href="/driver/exportCSV">Дамб В CSV</a>
</button>
<button>
    <a href="/driver/exportXML">Дамб В XML</a>
</button>
<button>
    <a href="/driver/exportYAML">Дамб В Yaml</a>
</button>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>ФИО водителя</th>
            <th>Стаж</th>
            <th>№ паспорта</th>
            <th>Место прописки</th>
            <th>Телефон</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($drivers as $driver)
            <tr>
                <td>{{ $driver->Name }}</td>
                <td>{{ $driver->Experience }}</td>
                <td>{{ $driver->Number_passport }}</td>
                <td>{{ $driver->Place_residence }}</td>
                <td>{{ $driver->Phone }}</td>
                <td>
                    <a href="{{ route('drivers.edit', $driver) }}">Редактировать</a>

                    <form action="{{ route('drivers.destroy', $driver) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $drivers->links() }} <!-- Пагинация -->
@endsection
