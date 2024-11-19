@extends('layouts.app')

@section('content')
<h1>Список гаражей</h1>
<a href="{{ route('garages.create') }}">Добавить гараж</a>
<button>
    <a href="/garage/export">Дамб В Excel</a>
</button>
<button>
    <a href="/garage/exportTXT">Дамб В txt</a>
</button>
<button>
    <a href="/garage/exportCSV">Дамб В CSV</a>
</button>
<button>
    <a href="/garage/exportXML">Дамб В XML</a>
</button>
<button>
    <a href="/garage/exportYAML">Дамб В Yaml</a>
</button>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Тип поломки</th>
            <th>Вид запчасти</th>
            <th>Цена запчасти</th>
            <th>Дата начала ремонта</th>
            <th>Дата конца реманта</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($garages as $garage)
            <tr>
                <td>{{ $garage->Type_failure }}</td>
                <td>{{ $garage->Type_of_spare_part }}</td>
                <td>{{ $garage->Spare_part_price }}</td>
                <td>{{ $garage->Repair_start_date }}</td>
                <td>{{ $garage->Repair_end_date }}</td>
                <td>
                    <a href="{{ route('garages.edit', $garage) }}">Редактировать</a>

                    <form action="{{ route('garages.destroy', $garage) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $garages->links() }} <!-- Пагинация -->
@endsection
