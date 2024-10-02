<x-app-layout>
    <div>
        <h1 class="text-4xl font-semibold mb-4">Purchase History</h1>

        @if ($orders->isEmpty())
            <p>No purchase history found.</p>
        @else
            <div class="space-y-4"> <!-- เพิ่มระยะห่างระหว่างการ์ด -->
                @foreach ($orders as $order)
                    <x-purchase-card :order="$order" />
                @endforeach
            </div>

            <!-- Pagination links -->
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-app-layout>