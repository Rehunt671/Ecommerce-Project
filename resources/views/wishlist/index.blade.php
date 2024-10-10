<x-app-layout>
    <section>
        <h1 >WISH LIST</h1> <!-- Added margin below the title -->
    </section>

        <section>
        <div class="flex justify-between">
            <div class="md:block w-1/6"></div>
            <div class="grid grid-cols-5 gap-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5"> 
                @foreach($products as $product)
                    <x-wishlist-card :product="$product" /> <!-- Only one call per product -->
                @endforeach
            </div>  
            <div class="md:block w-1/6"></div>
        </div>
        <!-- Pagination Links -->
        <div class="mt-4"> <!-- Added margin-top here for spacing -->
            {{ $products->links() }} 
        </div>
    </section>

</x-app-layout>
