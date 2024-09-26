<nav class="w-full py-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center px-6">
        <!-- Left side: Navigation Links -->
        <div class="flex space-x-8">
            <a href="/" class="text-lg font-semibold text-gray-800 hover:text-blue-700">HOME</a>
            <a href="/human" class="text-lg font-semibold text-gray-800 hover:text-blue-700">HUMAN</a>
            <a href="/pet" class="text-lg font-semibold text-gray-800 hover:text-blue-700">PET</a>
            <a href="/farm" class="text-lg font-semibold text-gray-800 hover:text-blue-700">FARM</a>
            <a href="/wishlist" class="text-lg font-semibold text-gray-800 hover:text-blue-700">WISH LIST</a>
            <a href="/cart" class="text-lg font-semibold text-gray-800 hover:text-blue-700">MY CART</a>
        </div>

        <!-- Right side: Authentication Links -->
        <div class="flex space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-lg font-semibold text-gray-800 hover:text-blue-700">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-lg font-semibold text-gray-800 hover:text-blue-700">LOGIN</a>
                    <span>|</span>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-lg font-semibold text-gray-800 hover:text-blue-700">SIGNUP</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>
