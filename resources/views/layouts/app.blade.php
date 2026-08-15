<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="grid grid-cols-[250px_1fr] grid-rows-[60px_1fr] [grid-template-areas:'header_header''sidebar_main'] h-screen w-screen overflow-hidden bg-gray-100">
            @include('layouts.header')
            @include('layouts.sidebar')
            <main class="[grid-area:main] overflow-y-auto relative">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
