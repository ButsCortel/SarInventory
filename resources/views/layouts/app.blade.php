<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/fa.css') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">



    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/nondefer.js') }}"></script>
    <script src="{{asset('js/barcode128.min.js')}}"></script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 h-screen overflow-y-auto">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}

        </main>

    </div>

    @include('components.checkout-modal')

    <div onclick="closeScanner()" class="scanner hidden bg-gray-500 bg-opacity-50 z-10 fixed flex justify-center inset-0 items-center h-screen w-screen">
        <div>
            <p class="bg-black text-white text-center font-bold text-xl">Scan the barcode:</p>
            <video onclick="event.stopPropagation()" class="bg-black h-72 w-80" id="video"></video>
        </div>
    </div>

</body>

</html>