<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('garages.index') }}">Гараж</a></li>
            <li><a href="{{ route('cars.index') }}">Автомобили</a></li>
            <li><a href="{{ route('controlls.index') }}">Диспетчерская</a></li>
            <li><a href="{{ route('drivers.index') }}">Водители</a></li>
            <li><a href="{{ route('products.index') }}">Товар</a></li>
            <li><a href="{{ route('travels.index') }}">Маршрут</a></li>
            <li><a href="{{ route('home') }}">главная</a></li>
            <li><a href="{{ route('about') }}">О нас</a></li>
            <li><a href="{{ route('contact') }}">Контакты</a></li>
        </ul>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
