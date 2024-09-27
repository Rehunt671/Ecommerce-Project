<x-app-layout>
    <h1 class="text-center">HUMAN</h1>
    <!-- Search Section -->
    <section class="my-10 text-center">
        <div class="flex justify-center items-center bg-gray-200 rounded-full mx-auto w-1/2">
            <input type="text" placeholder="Search" class="p-2 w-full outline-none rounded-l-full bg-transparent" />
            <button class="p-2">
                <img src="{{ asset('storage/search-icon.png') }}" alt="Search" />
            </button>
        </div>
        <div class="pagination mt-4 flex justify-center items-center space-x-2">
            <button class="text-xl px-3 py-2 bg-gray-200 rounded-full hover:bg-gray-300 focus:outline-none">
                &lt;
            </button>
            <span class="flex space-x-1">
                <button class="text-lg px-3 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 focus:outline-none">
                    1
                </button>
                <button class="text-lg px-3 py-2 bg-gray-200 rounded-full hover:bg-gray-300 focus:outline-none">
                    2
                </button>
                <button class="text-lg px-3 py-2 bg-gray-200 rounded-full hover:bg-gray-300 focus:outline-none">
                    3
                </button>
                <button class="text-lg px-3 py-2 bg-gray-200 rounded-full hover:bg-gray-300 focus:outline-none">
                    4
                </button>
                <button class="text-lg px-3 py-2 bg-gray-200 rounded-full hover:bg-gray-300 focus:outline-none">
                    5
                </button>
                <!-- Add more as needed -->
            </span>
            <button class="text-xl px-3 py-2 bg-gray-200 rounded-full hover:bg-gray-300 focus:outline-none">
                &gt;
            </button>
        </div>
    </section>

    <!-- Products Section -->
    <section >
        <div class="grid grid-cols-5 gap-10 justify-items-center">
            <!-- Product Card 1 -->
            <x-product-card 
            image="{{ asset('storage/dog_food.png') }}" 
            price="15,000" 
        />
          
            <!-- Repeat for other cards -->
        </div>
    </section>
</x-app-layout>
