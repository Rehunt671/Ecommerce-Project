<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex items-center justify-center ">
    <div class="bg-white bg-opacity-90 rounded-lg p-10 shadow-lg w-full max-w-4xl mt-40">
        <h1 >Mai Ghao Phung</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4 flex flex-col lg:space-y-4">
            @csrf <!-- CSRF token for security -->

            <!-- Email Input -->
            <div>
                <input type="email" name="email" placeholder="E-mail" class="w-full border-2 border-gray-300 rounded-full p-4 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-5">
                <input type="password" name="password" placeholder="Password" class="w-full border-2 border-gray-300 rounded-full p-4 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Login Button -->
            <div class="flex justify-center mt-20">
            <button type="submit" class="bg-black text-white rounded-md px-6 py-3 hover:bg-gray-800 transition duration-200 focus:outline-none text-lg shadow-md hover:shadow-lg">
                Login
            </button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>
