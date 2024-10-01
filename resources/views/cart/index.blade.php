<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Shopping Cart</h1>

        @if ($cartItems->isEmpty())
            <p class="text-gray-600">Your cart is empty.</p>
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
                        @foreach ($cartItems as $item)
                            <tr>
                                <td class="py-3 px-4 border-b">{{ $item->product->name }}</td>
                                <td class="py-3 px-4 border-b">
                                    <input type="number" value="{{ $item->quantity }}" min="1" class="border rounded-md w-16 text-center">
                                </td>
                                <td class="py-3 px-4 border-b">${{ number_format($item->product->price, 2) }}</td>
                                <td class="py-3 px-4 border-b">${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                                <td class="py-3 px-4 border-b">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="inline">
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
                    <h2 class="text-lg font-semibold">Subtotal: ${{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->product->price), 2) }}</h2>
                    <a href="{{ route('checkout') }}" class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 transition duration-200">Proceed to Checkout</a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
