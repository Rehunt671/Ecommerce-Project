<x-app-layout>
    <!-- Signup Form -->
    <div class="flex justify-center items-center mt-10">
        <div class="bg-white bg-opacity-90 rounded-lg p-10 shadow-lg w-full max-w-4xl">
            <form method="POST" action="{{ route('register') }}" class="space-y-4 flex flex-col lg:flex-row lg:space-y-0 lg:space-x-8" enctype="multipart/form-data">
                @csrf
                
                <!-- Left side of form (Inputs) -->
                <div class="w-full lg:w-2/3 space-y-4">
                    <div>
                        <input type="text" name="name" placeholder="Name" class="w-full border-2 mt-5 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                    </div>
                    <div>
                        <input type="text" name="email" placeholder="Username" class="w-full border-2 mt-5 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password" class="w-full mt-5 border-2 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full border-2 mt-5 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                    </div>
                    <div>
                        <input type="tel" name="phone" placeholder="Phone Number" class="w-full border-2 mt-5 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <input type="text" name="location" placeholder="Location" class="w-full border-2 mt-5 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                </div>
                
                <!-- Right side of form (Picture Upload and Confirm Information) -->
                <div class="w-full lg:w-1/3 flex flex-col items-center mt-6 lg:mt-0">
                    <div class="w-60 h-80 mt-5 border-2 border-gray-300 rounded-lg flex items-center justify-center text-gray-500 mb-4">
                        <input type="file" name="profile_picture" accept="image/*" class="hidden" id="profile_picture">
                        <label for="profile_picture" class="cursor-pointer">Add Picture</label>
                    </div>
                    <div class="flex items-center space-x-2 mt-4">
                        <input type="checkbox" id="confirm" name="confirm" class="form-checkbox h-5 w-5 text-red-500" required>
                        <label for="confirm" class="text-red-500 font-bold">Confirm Information</label>
                    </div>
                    <!-- Signup Button -->
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="bg-blue-600 text-white py-3 px-8 rounded-full font-bold transition-all duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Signup
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
