<x-app-layout>
    <h1 class="text-5xl font-bold mb-4">Ratings</h1>

    @if($ratings->isEmpty())
        <p class="text-gray-600 text-center">No ratings available for this product.</p>
    @else
        <div class="bg-white shadow-md rounded-lg p-4 w-1/2 mx-auto"> 
            <ul class="space-y-4">
                @foreach($ratings as $rating)
                    <li class="border-b pb-2">
                        <div class="flex items-center">
                            <!-- Display stars -->
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $rating->rating)
                                    <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 .587l3.668 7.431 8.232 1.199-5.951 5.56 1.408 8.194L12 18.896l-7.357 3.867 1.408-8.194-5.951-5.56 8.232-1.199L12 .587z"/>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 .587l3.668 7.431 8.232 1.199-5.951 5.56 1.408 8.194L12 18.896l-7.357 3.867 1.408-8.194-5.951-5.56 8.232-1.199L12 .587z"/>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <strong class="text-lg ml-2">Comment:</strong> {{ $rating->review_text }}<br>
                        <small class="text-gray-500">By {{ $rating->user->name }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</x-app-layout>
