<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Write a Review for {{ $product->name }}</h2>

        <form action="{{ route('rating.add', ['product' => $product->id]) }}" method="POST">
            @csrf

            <!-- ฟิลด์สำหรับกรอกคะแนน -->
            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating (1-5)</label>
                <input type="number" name="rating" id="rating" min="1" max="5" required
                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    oninput="validateRating(this)">
            </div>

            <!-- ฟิลด์สำหรับกรอกรีวิว -->
            <div class="mb-6">
                <label for="review_text" class="block text-sm font-medium text-gray-700 mb-1">Review</label>
                <textarea name="review_text" id="review_text" rows="5"
                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Write your review here..."></textarea>
            </div>

            <!-- ปุ่ม Submit -->
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-200">
                Submit Review
            </button>
        </form>
    </div>

    <script>
        function validateRating(input) {
            let value = parseInt(input.value);
            // ปัดเป็น 1 ถ้าค่าต่ำกว่า 1
            if (value < 1) {
                input.value = 1;
            }
            // ปัดเป็น 5 ถ้าค่ามากกว่า 5
            else if (value > 5) {
                input.value = 5;
            }
        }
    </script>
</x-app-layout>
