<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
</head>
<body>
    @include('layouts.navigation')

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                @foreach (['success', 'error', 'warning', 'info'] as $msg)
                    @if(session()->has($msg))
                        <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                            {{ session($msg) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @yield('content')
    </div>

    @include('modals.excelImport')

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#table-container').on('click', '.pointer', function () {
                window.location = $(this).data('href');
            });
        });

        const quill = new Quill('#editor', {
            theme: 'snow',
        });
    </script>
    @stack('scripts')
</body>
</html>
