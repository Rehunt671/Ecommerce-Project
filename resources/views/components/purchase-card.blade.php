<div class="w-1/2 p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl mb-6 px-6 mx-auto"> <!-- เปลี่ยน width เป็น full -->
    <div class="p-2">
        <!-- Display Order ID และ วันที่การสั่งซื้อ -->
        <h2 class="font-bold text-xl mb-2">Order ID: {{ $order->id }}</h2>
        <p class="text-gray-600">Purchase Date: {{ \Carbon\Carbon::parse($order->purchase_date)->format('d M Y, H:i') }}</p>

        <!-- Loop through order items และเรียงไปทางขวา -->
        <div class="flex overflow-x-auto space-x-4 mt-4"> <!-- ใช้ flex เพื่อจัดเรียงสินค้าแนวนอน -->
            @foreach($order->orderItems as $item)
                <div class="w-48 flex-shrink-0"> <!-- กำหนดความกว้างแต่ละสินค้า -->
                    <div class="relative h-64 rounded-md overflow-hidden">
                        <img src="{{ asset('storage/' . $item->product->image_name) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover" />
                        <h3 class="absolute bottom-0 left-0 right-0 bg-gray-800 bg-opacity-75 text-white text-center p-2">
                            {{ number_format($item->product->price, 2) }} ฿
                        </h3>
                    </div>
                    <div class="p-2">
                        <h2 class="font-bold text-lg mb-2">{{ $item->product->name }}</h2>
                        <p class="text-sm text-gray-600">{{ $item->product->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>