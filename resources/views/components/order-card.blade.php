<a href="{{ route('purchase.index', ['orderId' => $order->id]) }}" class="block bg-white shadow-md rounded-lg p-6 mb-4 transition hover:bg-gray-100">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-lg font-bold">Order #{{ $order->id }}</h3>
            <p class="text-sm text-gray-600">Placed on: {{ $order->created_at->format('M d, Y') }}</p>
        </div>
        <div>
            <span class="text-sm text-gray-800">{{ $order->status }}</span>
        </div>
    </div>

    <div class="mt-4">
        <p class="text-sm text-gray-500">Total: ${{ number_format($order->orderItems->sum(function ($item) { return $item->price_per_item * $item->quantity_sold; }), 2) }}</p>
        <p class="text-sm text-gray-500">Items: {{ $order->orderItems->count() }}</p>
    </div>
</a>
