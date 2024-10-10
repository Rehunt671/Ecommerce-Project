<x-app-layout>
    <div class="flex justify-between">
        <div class=" md:block w-1/6">  
        </div>
        <div class="grid grid-cols-5 gap-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 md:gap-6 lg:gap-10">
            <div class="col-span-3 flex flex-col items-center text-center">
                <h1 class="mb-20">{{ $category->name }}</h1>
                <div class="w-full">
                    <x-search-product-button :category="$category"/>
                </div>
            </div>
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
        <div class=" md:block w-1/6"> 
        </div>
    </div>
</x-app-layout>
