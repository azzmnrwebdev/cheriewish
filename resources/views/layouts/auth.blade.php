<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    {{-- Vite Resource --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Title --}}
    <title>{{ $title ? $title . ' - Cheriewish' : 'Cheriewish' }}</title>

    {{-- Custom CSS --}}
    <style>
        body {
            width: 100%;
            height: 100%;
            max-height: 100vh;
            background-color: #f1f5f9;
            font-family: "Nunito Sans", sans-serif;
        }

        main {
            height: 100vh;
            overflow: hidden;
        }

        /* Universal */
        .card-title,
        .card-subtitle {
            color: #333333;
        }

        .form-control:focus {
            border-color: #343a40;
            outline: #343a40 solid 1px;
        }

        .form-control:focus,
        .form-control.is-invalid:focus {
            box-shadow: none
        }

        .input-group-text i,
        .form-control::placeholder {
            color: #696969;
        }

        .input-group-text#toggle-password i:hover {
            cursor: pointer;
            color: #333333;
        }
    </style>

    @stack('styles')
</head>

<body>
    <main class="container">
        {{ $slot }}
    </main>

    {{-- Custom Javascript --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @stack('scripts')
</body>

</html>
