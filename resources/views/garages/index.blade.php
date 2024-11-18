@extends('layouts.app')

@section('content')
<h1>Список студентов</h1>
<a href="{{ route('garages.create') }}">Добавить гараж</a>
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

{{ $students->links() }} <!-- Пагинация -->
@endsection
