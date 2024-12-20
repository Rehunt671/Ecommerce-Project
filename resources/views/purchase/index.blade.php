<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1>Purchase Page</h1>
        @if (is_null($order))
            <p class="text-black-600">No order.</p>
        @else
            @foreach ($order as $o) <!-- Loop through each order -->
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <table class="w-full text-left border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b">Product</th>
                                <th class="py-3 px-4 border-b">Quantity</th>
                                <th class="py-3 px-4 border-b">Price</th>
                                <th class="py-3 px-4 border-b">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($o->orderItems as $item)
                                @if ($item && $item->product) <!-- Check for orderItems and product -->
                                    <tr>
                                        <td class="py-3 px-4 border-b flex items-center space-x-2">
                                            <span>{{ $item->product->name }}</span>
                                            <img src="{{ asset('storage/' . $item->product->image_name) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-md">
                                        </td>
                                        <td class="py-3 px-4 border-b">{{ $item->quantity_sold }}</td> <!-- Display quantity -->
                                        <td class="py-3 px-4 border-b">{{ $item->price_per_item }}</td> <!-- Display price per item -->
                                        <td class="py-3 px-4 border-b">{{ $item->quantity_sold * $item->price_per_item }}</td> <!-- Display total price -->
                                             <!-- Display product image -->
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Subtotal and Payment Button -->
                    <div class="mt-4 flex justify-between">
                        <h2 class="text-lg font-semibold">Subtotal: ${{ number_format($o->orderItems->sum(function ($orderItem) {
                                return $orderItem->quantity_sold * $orderItem->price_per_item;
                            }), 2) }}
                        </h2>
                        <form method="POST" action="{{ route('purchase.confirm', ['orderId' => $o->id]) }}">
                            @csrf
                            <button type="submit" class="bg-black text-white rounded-md px-4 py-2 hover:bg-gray-800 transition duration-200 focus:outline-none">
                                Confirm payment
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
