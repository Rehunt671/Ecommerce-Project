<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Purchase Page</h1>
        @if (is_null($order))
            <p class="text-black-600">No order.</p>
        @else
            <div class="bg-white shadow-md rounded-lg p-6">
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
                        @foreach ($order as $o)
                            @foreach ($o->orderItems as $item)
                                @if ($item && $item->product) <!-- ตรวจสอบว่ามี order_items และ product -->
                                    <tr>
                                        <td class="py-3 px-4 border-b">{{ $item->product->name }}</td>
                                        <td class="py-3 px-4 border-b">{{ $item->quantity_sold }}</td> <!-- แสดงจำนวนสินค้า -->
                                        <td class="py-3 px-4 border-b">{{ $item->price_per_item }}</td> <!-- แสดงราคาต่อหน่วย -->
                                        <td class="py-3 px-4 border-b">{{ $item->quantity_sold * $item->price_per_item }}</td> <!-- แสดงราคารวม -->
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 flex justify-between">
                    <h2 class="text-lg font-semibold">Subtotal: ${{ number_format($order->sum(function ($item) {
                            return $item->orderItems->sum(function ($orderItem) {
                                return $orderItem->quantity_sold * $orderItem->price_per_item;
                            });
                        }), 2) }}
                    </h2>
                    <form method="POST" action="{{ route('purchase.confirm', ['orderId' => $o->id]) }}">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 transition duration-200">Confirm payment</button>
                    </form>

                </div>
            </div>
        @endif
    </div>
</x-app-layout>
