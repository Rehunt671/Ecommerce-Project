<x-app-layout>
    <section class="my-10 text-center">
        <h1>Purchase History</h1>
        <div class="flex justify-center items-center bg-gray-200 rounded-full mx-auto w-1/2">
            <input type="text" placeholder="Search" class="p-2 w-full outline-none rounded-l-full bg-transparent" />
            <button class="p-2">
                <img src="{{ asset('/storage/search-icon.png') }}" alt="Search" />
            </button>
        </div>
    </section>

    <section>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6 lg:gap-10 justify-items-center">
            @foreach($products as $product)
                <div>
                    <x-purchase-card :product="$product" />
                </div>
            @endforeach
        </div>  

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $purchaseHistory->links() }} 
        </div>
    </section>
</x-app-layout>
