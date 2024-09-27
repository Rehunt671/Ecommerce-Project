<nav class="w-full py-4 bg-white bg-opacity-70 fixed top-0 z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        <div class="flex space-x-8">
            <a href="/" class="text-xl font-semibold text-gray-800 hover:text-blue-700">HOME</a>
            <a href="/human" class="text-xl font-semibold text-gray-800 hover:text-blue-700">HUMAN</a>
            <a href="/pet" class="text-xl font-semibold text-gray-800 hover:text-blue-700">PET</a>
            <a href="/farm" class="text-xl font-semibold text-gray-800 hover:text-blue-700">FARM</a>
            <a href="/wishlist" class="text-xl font-semibold text-gray-800 hover:text-blue-700">WISH LIST</a>
            <a href="/cart" class="text-xl font-semibold text-gray-800 hover:text-blue-700">MY CART</a>
        </div>

        <div class="flex space-x-4">
            @if (Route::has('login'))
                @auth
                @else
                    <a href="{{ route('login') }}" class="text-xl font-semibold text-gray-800 hover:text-blue-700">LOGIN</a>
                    <span>|</span>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-xl font-semibold text-gray-800 hover:text-blue-700">SIGNUP</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>
