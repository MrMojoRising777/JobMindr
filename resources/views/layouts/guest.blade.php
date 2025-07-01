<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/js/app.js'])
</head>
<body>

    <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="mb-4">
            <a href="/">
{{--                <img src="{{ asset('logo.png') }}" alt="Logo" width="80" height="80">--}}
                LOGO
            </a>
        </div>

        <div class="w-100" style="max-width: 400px;">
            <div class="card shadow-sm">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</body>
</html>
