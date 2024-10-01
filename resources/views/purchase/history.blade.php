<x-app-layout>
    <div>
        <h3>Purchase History</h3>

        @if ($orders->isEmpty()) <!-- Check if orders is empty -->
            <p>No purchase history found.</p>
        @else
            @foreach ($orders as $order) <!-- Loop through each order -->
                <div>
                    <h4>Order ID: {{ $order }}</h4>
                    <p>Purchase Date: {{ \Carbon\Carbon::parse($order->purchase_date)->format('d M Y, H:i') }}</p>

                    <h5>Order Items:</h5>
                    @if (!empty($order->order_items) && count($order->order_items) > 0) 
                        <ul>
                            @foreach ($order->order_items as $orderItem)
                                <li>
                                    Product Name: {{ $orderItem->product->name }}<br>
                                    Quantity Sold: {{ $orderItem->quantity_sold }}<br>
                                    Price per Item: ${{ $orderItem->price_per_item }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No items in this order.</p> <!-- Message for orders without items -->
                    @endif
                </div>
            @endforeach

            <!-- Pagination links -->
            {{ $orders->links() }} <!-- This will display pagination links -->
        @endif
    </div>
</x-app-layout>


