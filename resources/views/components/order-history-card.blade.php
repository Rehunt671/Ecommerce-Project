@foreach($order->orderItems as $item)
    <div class="mb-5 bg-white border p-4 rounded-lg ">
        <img src="{{ asset('storage/' . $item->product->image_name) }}" alt="{{ $item->name }}" class="w-full h-32 object-cover mb-4">
        <h3 class="text-lg font-semibold">{{ $item->product->name }}</h3>
        <p class="text-gray-700">จำนวนสินค้า: {{ number_format($item->quantity_sold) }}</p>
        <p class="text-gray-700"> ราคาต่อหน่วย: ฿{{ number_format($item->product->price, 2) }}</p>
        <hr class="w-full h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        <p class="text-red-600 font-bold">รวมการสั่งซื้อ: ฿{{ number_format($item->product->price * $item->quantity_sold, 2) }}</p>
        <div class="flex justify-between items-center mt-4">
            <a href="{{route('rating.form',['productId'=> $item->product->id])}}" class="bg-orange-500 text-white rounded px-4 py-2">ให้คะแนน</a>
            <a class="bg-gray-300 rounded px-4 py-2">ติดต่อผู้ขาย</a>
            <a class="bg-blue-500 text-white rounded px-4 py-2">ซื้ออีกครั้ง</a>
        </div>
        <p class="text-gray-500 text-sm mt-2">จัดส่งภายใน: {{ $item->delivery_date }}</p>
    </div>
@endforeach
