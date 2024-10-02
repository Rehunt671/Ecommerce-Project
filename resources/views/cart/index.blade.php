<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Shopping Cart</h1>

        @if ($cartProducts->isEmpty())
            <p class="text-black-600">Your cart is empty.</p>
        @else
            <div class="bg-white shadow-md rounded-lg p-6">
                <table class="w-full text-left border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-4 border-b">Product</th>
                            <th class="py-3 px-4 border-b">Quantity</th>
                            <th class="py-3 px-4 border-b">Price</th>
                            <th class="py-3 px-4 border-b">Total</th>
                            <th class="py-3 px-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartProducts as $item)
                            <tr>
                            <td class="py-3 px-4 border-b">{{ $item->name }}</td>
                                <td class="py-3 px-4 border-b">
                                    <form action="{{ route('cart.upsert') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->pivot->product_id }}">
                                        <input type="hidden" name="operation" value="minus">
                                        <button type="submit" class="text-gray-500 hover:text-gray-700">-</button>
                                    </form>
                                    {{ $item->pivot->quantity }} <!-- แสดงจำนวนสินค้า -->
                                    <form action="{{ route('cart.upsert') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->pivot->product_id }}">
                                        <input type="hidden" name="operation" value="add">
                                        <button type="submit" class="text-gray-500 hover:text-gray-700">+</button>
                                    </form>
                                </td>
                                <td class="py-3 px-4 border-b">${{ number_format($item->price, 2) }}</td>
                                <td class="py-3 px-4 border-b">${{ number_format($item->pivot->quantity * $item->price, 2) }}</td>
                                <td class="py-3 px-4 border-b">
                                <form action="{{ route('cart.delete', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4 flex justify-between">
                    <h2 class="text-lg font-semibold">Subtotal: ${{ number_format($cartProducts->sum(fn($item) => $item->pivot->quantity * $item->price), 2) }}</h2>
                    
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
