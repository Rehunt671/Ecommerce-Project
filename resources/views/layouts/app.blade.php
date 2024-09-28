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
        <link href='https://fonts.googleapis.com/css?family=Rubik Bubbles' rel='stylesheet'>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">

            <nav >
                @include('layouts.navigation')
            </nav>

            <!-- @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset -->

            <main class="mt-40">
                {{ $slot }}
            </main>


            <button id="scrollToTopBtn" class="fixed bottom-20 right-20 hidden bg-pink-500 text-white rounded-full p-3 shadow-lg transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                ↑
            </button>

            <script>
                const scrollToTopBtn = document.getElementById("scrollToTopBtn");

                window.onscroll = function() {
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        scrollToTopBtn.classList.remove("hidden");
                    } else {
                        scrollToTopBtn.classList.add("hidden");
                    }
                };

                scrollToTopBtn.onclick = function() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                };
            </script>
    </body>
</html>
