<x-app-layout>
    <div class="flex justify-between">
        <div class=" md:block w-1/6">  
        </div>
        <div class="grid grid-cols-5 gap-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5  md:gap-6 lg:gap-10">
            <div class="col-span-3 flex flex-col items-center text-center">
                <h1 class="mb-20">{{ $category->name }}</h1>
                <div class="w-full">
                    <form action="{{ route('products.category', $category->id) }}" method="GET" class="relative"> 
                        <input
                            name="query" 
                            value="{{ request()->query('query') }}"
                            class="w-full placeholder:text-slate-400 text-slate-700 text-lg border border-slate-200 rounded-md pl-4 pr-32 py-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" 
                            placeholder="Food, Toy"
                        />
                        <button
                            class="absolute top-1 right-1 flex items-center rounded bg-slate-800 py-2 px-4 border border-transparent text-center text-lg text-white transition-all shadow-sm hover:shadow focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" 
                            type="submit"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                            </svg>
                            Search
                        </button> 
                    </form>
                </div>
            </div>
            @foreach($products as $product)
                    <x-product-card :product="$product" />
            @endforeach
        </div>
        <div class=" md:block w-1/6"> 
        </div>
    </div>
    <div class="mt-4">
        {{ $products->links() }} 
    </div>
</x-app-layout>
