<x-app-layout>
<div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row bg-white shadow-md rounded-lg">
        <div class="md:w-1/2">
            <img src="{{ asset('storage/products/' . $product->image_name) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-t-lg md:rounded-l-lg md:rounded-tr-none">
        </div>
        <div class="md:w-1/2 p-6 flex flex-col">
            <h2 class="text-2xl font-semibold text-gray-800">{{ $product->name }}</h2>
            <p class="text-lg text-gray-600 mt-2">{{ $product->description }}</p>
            <p class="text-xl font-bold text-gray-800 mt-4">${{ number_format($product->price, 2) }}</p>
            <div class="flex mt-6 space-x-4">
                <form action="{{ route('cart.upsert') }}" method="POST" >
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="operation" value="add">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add to Cart</button>
                </form>
                <form action="{{ route('wishlist.toggle')}}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="category_id" value="{{ $product->category }}">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Add to Wishlist</button>
                </form>
                <button type="button" id="buyButton" class="bg-black text-white rounded-md px-4 py-2 hover:bg-gray-800 transition duration-200 focus:outline-none">
                    Buy
                </button>
            </div>
        </div>
    </div>

    <!-- Ratings Section -->
    <h1 class="mt-10 text-2xl font-semibold">Ratings</h1>

    @if($ratings->isEmpty())
        <p class="text-gray-600 text-center">No ratings available for this product.</p>
    @else
        <div class="bg-white shadow-md rounded-lg p-4 w-1/2 mx-auto">
            <ul class="space-y-4">
                @foreach($ratings as $rating)
                    <li class="border-b pb-2">
                        <div class="flex items-center">
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

<!-- Buy Form (hidden) -->
<form id="buyForm" method="POST" action="{{ route('order.add') }}" style="display: none;">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}"> 
    <input type="hidden" name="quantity" id="quantityInput" value="1" min="1">
</form>

<script>
    // Open modal when clicking Buy button
    document.getElementById('buyButton').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('quantityModal').classList.remove('hidden');
    });

    // Close modal when clicking cancel button
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('quantityModal').classList.add('hidden');
    });

    // Submit order when user clicks Submit
    document.getElementById('submitOrder').addEventListener('click', function() {
        const quantity = document.getElementById('quantity').value;
        document.getElementById('quantityInput').value = quantity;
        document.getElementById('buyForm').submit();
    });
</script>