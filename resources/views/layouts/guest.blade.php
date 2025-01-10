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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        html,
        body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        #navbar {
            z-index: 1000;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            backdrop-filter: blur(10px);
            background-color: transparent;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .navbar-toggler {
            padding: 0;
            border: none;
        }

        .navbar-toggler:focus,
        .navbar-toggler:active,
        .navbar-toggler-icon:focus {
            outline: none;
            box-shadow: none;
        }

        .navbar-nav .nav-item .nav-link {
            color: black;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
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

        .btn-close:focus {
            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #343a40;
            outline: #343a40 solid 1px;
        }

        .form-control:focus,
        .form-control.is-invalid:focus,
        .form-select:focus,
        .form-select.is-invalid:focus {
            box-shadow: none;
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
            border-color: #dc3545;
            outline: #dc3545 solid 1px;
        }

        .footer {
            border-top: 3px solid #AF1040;
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

    <script>
        $(document).ready(function() {
            $(window).on('scroll', function() {
                if ($(this).scrollTop() > 50) {
                    $('#navbar').addClass('bg-white shadow-sm').removeClass('bg-transparent');
                } else {
                    $('#navbar').removeClass('bg-white shadow-sm').addClass('bg-transparent');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
