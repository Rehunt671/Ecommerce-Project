<x-app-layout>
    <div class="flex justify-center items-center mt-60">
        <div class="bg-white bg-opacity-90 rounded-lg p-10 shadow-lg w-full max-w-4xl">
            <form method="POST" action="{{ route('register') }}" class="space-y-4 flex flex-col lg:flex-row lg:space-y-0 lg:space-x-8" enctype="multipart/form-data">
                @csrf
                
                <!-- Left side of form (Inputs) -->
                <div class="w-full lg:w-2/3 space-y-4">
                    <div>
                        <input type="text" name="name" placeholder="Name" class="w-full border-2 mt-5 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name') }}" required />
                        @error('name')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="email" placeholder="Username" class="w-full border-2 mt-5 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email') }}" required />
                        @error('email')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password" class="w-full mt-5 border-2 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                        @error('password')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full border-2 mt-5 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                        @error('password_confirmation')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input type="tel" name="phone" placeholder="Phone Number" class="w-full border-2 mt-5 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('phone') }}" />
                        @error('phone')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="location" placeholder="Location" class="w-full border-2 mt-5 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('location') }}" />
                        @error('location')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Right side of form (Picture Upload and Confirm Information) -->
                <div class="w-full lg:w-1/3 flex flex-col items-center mt-6 lg:mt-0" >
                    <div class="w-60 h-80 mt-5 border-2 border-gray-300 rounded-lg flex items-center justify-center text-gray-500 mb-4 relative cursor-pointer" onclick="document.getElementById('profile_picture').click();">
                        <input type="file" name="profile_picture" accept="image/*" class="hidden" id="profile_picture" onchange="previewImage(event)">
                        <span id="upload_text">Add Picture</span>
                        <img id="image_preview" class="hidden w-full h-full object-cover rounded-lg" />
                    </div>
                    <div class="flex items-center space-x-2 mt-4">
                        <input type="checkbox" id="confirm" name="confirm" class="form-checkbox h-5 w-5 text-red-500" required>
                        <label for="confirm" class="text-red-500 font-bold">Confirm Information</label>
                    </div>
                    <!-- Signup Button -->
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="bg-black text-white rounded-md px-4 py-2 hover:bg-gray-800 transition duration-200 focus:outline-none">
                            Signup
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            const imagePreview = document.getElementById('image_preview');
            const uploadText = document.getElementById('upload_text'); // Reference to the upload text

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadText.classList.add('hidden'); // Hide the upload text
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                imagePreview.classList.add('hidden');
                uploadText.classList.remove('hidden'); // Show the upload text if no file is selected
            }
        }
    </script>
</x-app-layout>
