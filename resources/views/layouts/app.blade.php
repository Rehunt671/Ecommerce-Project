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

        <!-- Custom Styles -->
        <style>
            body {
                background-image: url('/public/storage/thumb-1920-1354305.jpeg');
                background-size: cover;
                background-position: center;
                background-attachment: fixed; /* Makes the background fixed during scroll */
            }

            nav {
                background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
                backdrop-filter: blur(10px); /* Optional blur effect */
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">

            <nav class="bg-gray-100 dark:bg-gray-900">
                @include('layouts.navigation')
            </nav>

            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
