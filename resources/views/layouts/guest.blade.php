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
        <!-- Panduan Button - Positioned prominently -->
        <div class="absolute z-30 top-6 right-6">
            <a href="https://drive.google.com/file/d/1Lca7dtT8Ol5uyjGlBRkH0C9ZbPC8Iiac/view?usp=sharing" target="_blank"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
                Panduan
            </a>
        </div>

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
