<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('public\css\bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('public\img\icon_logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>@yield('title')</title>
</head>
<body>
    <style>
        body {
            background-color: #1F2129;
        }, 
        p, h1, h2, h3, h4, h5, h6, div, select, input, label {
            color: white;
        }

        form, input {
            background-color: #282933 !important;
        }

        input, textarea {
            border: #950FFF 1px solid !important;
        }
    </style>
    @include('layout.navbar')
    <script src="{{ asset('public\js\bootstrap.bundle.js') }}"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    @yield('content')
    {{-- @include('layout.linePlay') --}}
</body>
</html>