<x-app-layout>
    <div class="container mx-auto">
        <h1 >Your Orders</h1>

        <!-- Tabs for pending and completed orders -->
        <div class="flex space-x-4 mb-6">
            <button id="pendingTab" class="tab-button bg-blue-500 text-white px-4 py-2 rounded focus:outline-none">Pending Orders</button>
            <button id="completedTab" class="tab-button bg-green-500 text-white px-4 py-2 rounded focus:outline-none">Completed Orders</button>
        </div>

        
        <!-- Pending Orders Section -->
        <div id="pendingOrders" class="tab-content">
            <h2 class="text-xl font-semibold mb-4">Pending Orders</h2>
            @if($pendingOrders->isEmpty())
                <p>You have no pending orders.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($pendingOrders as $order)
                            <x-order-card :order="$order" />
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Completed Orders Section -->
        <div id="completedOrders" class="tab-content hidden">
            <h2 class="text-xl font-semibold mb-4">Completed Orders</h2>
            @if($completedOrders->isEmpty())
                <p>You have no completed orders.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($completedOrders as $order)
                            <x-order-history-card :order="$order" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('pendingTab').addEventListener('click', function() {
            document.getElementById('pendingOrders').classList.remove('hidden');
            document.getElementById('completedOrders').classList.add('hidden');
        });

        document.getElementById('completedTab').addEventListener('click', function() {
            document.getElementById('completedOrders').classList.remove('hidden');
            document.getElementById('pendingOrders').classList.add('hidden');
        });
    </script>
</x-app-layout>
