<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="flex flex-col md:flex-row bg-gradient-to-r from-gray-50 via-white to-gray-50 shadow-lg rounded-lg overflow-hidden ">
            <div class="md:w-1/2 hover:opacity-90  transform transition-opacity duration-300 ">
                <img src="{{ asset('storage/' . $product->image_name) }}"
                alt="{{ $product->name }}" 
                class="w-full h-full object-cover transition-transform duration-300 transform group-hover:scale-110" />
            </div>
            <div class="md:w-1/2 p-8 flex flex-col relative ">
                <h2 class="text-3xl font-semibold text-gray-800 leading-tight">{{ $product->name }}</h2>
                <p class="text-lg text-gray-600 mt-3 leading-relaxed">{{ $product->description }}</p>
                <p class="text-2xl font-bold text-gray-800 mt-6">฿{{ number_format($product->price, 2) }}</p>
                <!-- <p class="text-2xl font-bold text-gray-800 mt-6">การจัดส่ง : </p>
                <p class="text-2xl font-bold text-gray-800 mt-6">ชนิด: </p>
                <p class="text-2xl font-bold text-gray-800 mt-6">ตัวเลือก2: </p> -->
                <div class="absolute bottom-40 flex items-center space-x-4 mt-6">
                    <p class="flex text-3xl font-bold text-gray-800">จำนวน:</p>
                    <button id="decreaseQuantity" class="bg-gray-300 rounded-md p-4 text-2xl">-</button>
                    <input id="quantity" value="1" min="1" class="border rounded-md px-4 py-2 w-40 text-center text-2xl">
                    <button id="increaseQuantity" class="bg-gray-300 rounded-md p-4 text-2xl">+</button>
                </div>
                
                <div class="absolute bottom-20 left-8 right-8 flex items-center justify-between mt-8  ">
                    <div class="relative">
                        <form method="POST" action="{{ route('cart.upsert') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button aria-label="Add to cart" class="relative flex items-center bg-white text-white font-semibold rounded-full p-2 transition duration-300 focus:outline-none shadow-lg">
                                <img src="{{ asset('/storage/cart.png') }}" class="w-8 h-8" alt="Add to Cart" />
                                @if($product->cart_quantity > 0)
                                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2">{{ $product->cart_quantity }}</span>
                                @endif
                            </button>
                        </form>
                    </div>

                    <button type="button" id="buyButton" class="bg-gradient-to-r from-black to-gray-800 text-white font-semibold rounded-md px-6 py-3 hover:from-gray-800 hover:to-black transition duration-200 focus:outline-none shadow-lg">
                        Buy Now
                    </button>

                    <form method="POST" action="{{ route('wishlist.toggle') }}" class="inline toggle-wishlist-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="focus:outline-none">
                            <svg class="w-10 h-auto {{ $product->is_wishlist ? 'text-red-500 hover:text-red-700' : '' }} transition-colors" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Ratings Section -->
    <h1 class="mt-10 mb-5 text-3xl font-semibold">Ratings</h1>

    @if($ratings->isEmpty())
        <p class="text-gray-600 text-center">No ratings available for this product.</p>
    @else
        <div class="bg-white shadow-md rounded-lg p-4 w-1/2 mx-auto ">
            <ul class="space-y-4">
                @foreach($ratings as $rating)
                    <li class="border-b pb-2 mb-5">
                        <div class="flex items-center ">
                            <!-- Display stars -->
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $rating->rating)
                                    <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 .587l3.668 7.431 8.232 1.199-5.951 5.56 1.408 8.194L12 18.896l-7.357 3.867 1.408-8.194-5.951-5.56 8.232-1.199L12 .587z"/>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 .587l3.668 7.431 8.232 1.199-5.951 5.56 1.408 8.194L12 18.896l-7.357 3.867 1.408-8.194-5.951-5.56 8.232-1.199L12 .587z"/>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <strong class="text-lg ml-2">Comment:</strong> {{ $rating->review_text }}<br>
                        <small class="text-gray-500">By {{ $rating->user_name }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</x-app-layout>

<form id="buyForm" method="POST" action="{{ route('order.add') }}" style="display: none;">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}"> 
    <input type="hidden" name="quantity" id="quantityInput" value="1" min="1">
</form>

<script>
    const quantityInput = document.getElementById('quantity');
    const buyButton = document.getElementById('buyButton');

    document.getElementById('increaseQuantity').addEventListener('click', function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    document.getElementById('decreaseQuantity').addEventListener('click', function() {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });

    buyButton.addEventListener('click', function() {
        const quantity = quantityInput.value;
        document.getElementById('quantityInput').value = quantity;
        document.getElementById('buyForm').submit(); 
    });
</script>