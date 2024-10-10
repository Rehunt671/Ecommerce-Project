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
        <!-- from node_modules -->
        <script
        type="module"
        src="node_modules/@material-tailwind/html@latest/scripts/popover.js"
        ></script>
        
        <!-- from cdn -->
        <script
        type="module"
        src="https://unpkg.com/@material-tailwind/html@latest/scripts/popover.js"
        ></script>
    </head>
    <body class="font-sans antialiased">
        <div >

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

            <main class="mt-20">
                {{ $slot }}
            </main>

            <button id="scrollToTopBtn" class="fixed bottom-20 right-20 hidden bg-pink-500 text-white rounded-full p-3 shadow-lg transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                ↑
            </button>

            <!-- <footer class="bg-gray-800 text-white py-8 fixed bottom-0 w-full">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h4 class="text-lg font-semibold mb-4">About Us</h4>
                            <p>Your go-to platform for pet care products. We offer quality products and fast shipping to ensure your pets are always happy.</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold mb-4">Customer Support</h4>
                            <ul>
                                <li><a href="#" class="hover:underline">Help Center</a></li>
                                <li><a href="#" class="hover:underline">Returns</a></li>
                                <li><a href="#" class="hover:underline">Order Tracking</a></li>
                                <li><a href="#" class="hover:underline">Contact Us</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="hover:text-gray-400">Facebook</a>
                                <a href="#" class="hover:text-gray-400">Instagram</a>
                                <a href="#" class="hover:text-gray-400">Twitter</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 text-center border-t border-gray-700 pt-4">
                        <p>&copy; 2024 Your E-commerce Platform. All rights reserved.</p>
                    </div>
                </div>
            </footer> -->

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
