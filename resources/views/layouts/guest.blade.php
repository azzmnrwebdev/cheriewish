<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Favicon --}}

    {{-- Vite Resource --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Title --}}
    <title>{{ $title ? $title . ' - Cheriewish' : 'Cheriewish' }}</title>

    {{-- Custom CSS --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        .navbar-toggler:focus,
        .navbar-toggler:active,
        .navbar-toggler-icon:focus {
            outline: none;
            box-shadow: none;
        }

        .navbar-nav .nav-item .nav-link {
            color: #555555;
            font-weight: 700;
        }

        .navbar-nav .nav-item .nav-link:hover,
        .navbar-nav .nav-item .nav-link.active {
            color: #AF1040;
        }

        .btn-pink {
            color: white !important;
            background-color: #AF1040;
            border-color: #AF1040 !important;
        }

        .btn-pink:hover,
        .btn-pink:focus {
            border-color: #da1450 !important;
            background-color: #da1450 !important;
        }
    </style>

    @stack('styles')
</head>

<body>
    {{-- Navbar --}}
    <x-navbar></x-navbar>

    {{-- Main Content --}}
    {{ $slot }}

    {{-- Custom Javascript --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @stack('scripts')
</body>

</html>
