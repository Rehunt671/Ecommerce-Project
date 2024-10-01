<div class="w-60 p-2 bg-white rounded-xl transform transition-all duration-300 shadow-lg hover:shadow-2xl">
    <div class="relative h-64 rounded-md overflow-hidden">
        <img src="{{ asset('storage/' . $product->image_name) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
        <h3 class="absolute bottom-0 left-0 right-0 bg-gray-800 bg-opacity-75 text-white text-center p-2">
            {{ number_format($product->price, 2) }} ฿
        </h3>
    </div>
    <div class="p-2">
        <h2 class="font-bold text-lg mb-2">{{ $product->name }}</h2>
        <p class="text-sm text-gray-600">{{ $product->description }}</p>
    </div>
    <div class="flex justify-between mt-6">
        <div class="relative">
            <form method="POST" action="{{ route('cart.upsert') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button aria-label="Add to cartItems" class="flex items-center hover:-translate-y-2">
                    <img src="{{ asset('/storage/cart.png') }}" class="w-10 h-auto" alt="Add to Cart" />
                    <!-- Cart Count Badge -->
                    @if($product->cart_quantity > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full px-2">{{ $product->cart_quantity }}</span>
                    @endif
                </button>
            </form>
        </div>
        <!-- Buy Immediately Button -->
        <form method="POST" action="{{ route('order.add') }}">
        @csrf
            <button type="button" id="buyButton" class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 transition duration-200 focus:outline-none">
            Buy
            </button>
        </form>
        <form method="POST" action="{{ route('wishlist.toggle') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="category_id" value="{{ $product->category }}">
            <button type="submit" class="focus:outline-none hover:-translate-y-2">
                <svg class="w-10 h-auto {{ $product->isWishlist ? 'text-red-500' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>
        </form>
    </div>
</div>


