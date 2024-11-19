@extends('layouts.app')

@section('content')
<h1>Список</h1>
<a href="{{ route('travels.create') }}">Добавить</a>
<button>
    <a href="/travel/export">Дамб В Excel</a>
</button>
<button>
    <a href="/travel/exportTXT">Дамб В txt</a>
</button>
<button>
    <a href="/travel/exportCSV">Дамб В CSV</a>
</button>
<button>
    <a href="/travel/exportXML">Дамб В XML</a>
</button>
<button>
    <a href="/travel/exportYAML">Дамб В Yaml</a>
</button>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Пункт назначения</th>
            <th>Расстояник, км</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($travels as $travel)
            <tr>
                <td>{{ $travel->Destination }}</td>
                <td>{{ $travel->Distance_km }}</td>
                <td>
                    <a href="{{ route('travels.edit', $travel) }}">Редактировать</a>

                    <form action="{{ route('travels.destroy', $travel) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $travels->links() }} <!-- Пагинация -->
@endsection
