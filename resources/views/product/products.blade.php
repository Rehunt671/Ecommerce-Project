<x-app-layout>
    <section class="my-10 text-center">
        <h1>{{ $category->name }}</h1>
        <div class="flex items-center justify-center">
            <x-search-bar />
        </div>
    </section>

    <section>
        <div class="flex justify-between">
            <div class=" md:block w-1/6"> <!-- Left Section -->
                <!-- Add any content you want in the left section -->
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6 lg:gap-10 justify-items-center mx-10">
                @foreach($products as $product)
                        <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class=" md:block w-1/6"> <!-- Right Section -->
                <!-- Add any content you want in the right section -->
            </div>
        </div>
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $products->links() }} 
        </div>
    </section>
</x-app-layout>
