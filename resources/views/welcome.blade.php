<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SarInventory - Welcome</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body class="antialiased">
    @if (Route::has('login'))
    <div class="fixed top-0 right-0 px-6 py-4 block">
        @auth
        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
        @endif
        @endauth
    </div>
    @endif

    <main class="h-screen flex flex-col items-center w-full">
        <div class="flex-grow flex justify-center items-center">
            <div class="text-center w-5/6 md:w-full">
                <h1 class="lg:text-7xl text-4xl font-bold ">
                    <span class="text-blue-500">Sar</span><span class="text-gray-400 ">In<span class="text-yellow-400">v</span>en<span class="text-red-500">tory</span>
                </h1>
                <p>Welcome to SarInventory!</p>
                <p>A POS System for sari-sari stores and small businesses.</p>
                <p><span class="text-sm border-b border-black">Features:</span></p>
                <ul class="text-sm">
                    <li>Inventory Management</li>
                    <li>Sales Summary</li>
                    <li>Barcode Capture (Webcam/Phone Cam)</li>
                </ul>
            </div>

        </div>
        @include('layouts.footer')
    </main>

</body>

</html>