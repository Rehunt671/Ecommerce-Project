<a href="{{ route('products.show', ['productId' => $product->id]) }}" class="w-60 p-2 bg-white rounded-xl transform transition-all duration-300 shadow-lg hover:shadow-2xl group flex flex-col">
    <div class="relative h-72 rounded-md overflow-hidden flex-grow">
        <img src="{{ asset('storage/' . $product->image_name) }}" 
             alt="{{ $product->name }}" 
             class="w-full h-full object-cover transition-transform duration-300 transform group-hover:scale-110" />
        <h3 class="absolute bottom-0 left-0 right-0 bg-gray-800 bg-opacity-75 text-white text-center p-2">
            {{ number_format($product->price, 2) }} ฿
        </h3>
    </div>
    <div class="p-2 flex-grow">
        <h2 class="font-bold text-lg mb-2">{{ $product->name }}</h2>
        <p class="text-sm text-gray-600">{{ $product->short_description }}</p>
    </div>

    <div class="mt-6">
        <button type="button" id="buyButton" class="bg-black text-white rounded-md w-full px-4 py-2 hover:bg-gray-800 transition duration-200 focus:outline-none">
            Buy Now
        </button>
    </div>
</a>



<!-- Modal -->
<div id="quantityModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-lg font-bold mb-4 text-center">Select Quantity</h2>
        <input type="number" id="quantity" value="1" min="1" class="border rounded-md px-2 py-1 w-full">
        <div class="mt-4 flex justify-end">
            <button id="submitOrder" class="bg-black text-white rounded-md px-4 py-2 hover:bg-gray-800 transition duration-200 focus:outline-none">
                Submit
            </button>
            <button id="closeModal" class="ml-2 bg-gray-300 text-gray-700 rounded-md px-4 py-2 hover:bg-gray-400 transition duration-200 focus:outline-none">
                Cancel
            </button>
        </div>
    </div>
</div>

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
