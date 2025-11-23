<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>sismon paljaya</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pal.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Login Background Style -->
    <style>
        .login-background {
            background-color: #f8f9fa;
            background-image: url('{{ asset(' images/pal-fr-gd.jpg') }}');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            min-height: 100vh;
        }

        /* Ensure background loads properly */
        .login-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset(' images/pal-fr-gd.jpg') }}');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            opacity: 0.7;
            z-index: 0;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="relative flex flex-col items-center pt-6 login-background sm:justify-center sm:pt-0">
        <!-- Overlay putih semi-transparan -->
        <div class="absolute inset-0 bg-white bg-opacity-30 z-5"></div>

        <!-- Content dengan z-index tinggi agar berada di atas overlay -->
        <div class="relative z-20 text-center">
            <a href="/">
                <x-application-logo class="w-20 h-20 mx-auto text-gray-500 fill-current" />
            </a>
            <div class="mt-4">
                <h1 class="text-lg font-semibold leading-tight text-gray-800">
                    SISTEM INFORMASI MONITORING BARANG HABIS PAKAI
                </h1>
                <h2 class="text-lg font-semibold leading-tight text-blue-800">PERUMDA PALJAYA</h2>
            </div>
        </div>

        <div
            class="relative z-20 w-full px-6 py-4 mt-6 overflow-hidden bg-white border border-gray-200 shadow-lg sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
