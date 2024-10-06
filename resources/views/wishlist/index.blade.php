<x-app-layout>
    <section>
        <h1>WISH LIST</h1>
    </section>

    <section>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6 lg:gap-10 justify-items-center">
                @foreach($products as $product)
            <div>
                <x-wishlist-card :product="$product" />
            </div>
        @endforeach
        </div>  
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $products->links() }} 
        </div>
    </section>
</x-app-layout>
