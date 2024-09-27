<div class="bg-white bg-opacity-70 rounded-lg p-6 shadow-lg flex flex-col justify-between w-56 h-80">
    <div class="relative bg-gray-50 h-64 rounded-md overflow-hidden">
        <img src="{{ $image }}" alt="Food" class="w-full h-full object-cover" />
        <h3 class="absolute bottom-0 left-0 right-0 bg-gray-800 bg-opacity-75 text-white text-center p-2">
            {{ $price }} ฿
        </h3>
    </div>
    <div class="product-actions flex justify-between mt-6">
        <button>
            <img src="{{ asset('storage/cart.png') }}" class="w-10 h-auto" alt="Cart" />
        </button>
        <button>
            <img src="{{ asset('storage/heart.png') }}" class="w-10 h-auto" alt="Heart" />
        </button>
    </div>
</div>
