<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Header: Mai Ghog Phung -->
    <!-- Login Form -->
    <div class="flex justify-center items-center mt-10">
        <div class="bg-white bg-opacity-90 rounded-lg p-10 shadow-lg w-full max-w-4xl">
            <h1>
                Mai Ghao Phung
            </h1>
            <form method="POST" action="{{ route('login') }}" class="space-y-4 flex flex-col lg:space-y-4" enctype="multipart/form-data">
                <!-- Add CSRF token -->
                @csrf
          <!-- Email and Password Inputs -->
                <div class="flex justify-center items-center">
                    <div class="w-full max-w-lg space-y-10"> <!-- Set a max-width for smaller input fields -->
                        <div>
                            <input type="email" name="email" placeholder="E-mail" class="w-full border-2 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                        </div>
                        <div class="mt-5"> <!-- Add margin-top to create space -->
                            <input type="password" name="password" placeholder="Password" class="w-full border-2 border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                        </div>
                    </div>
                </div>

                <!-- Login Button (Centered below the form inputs) -->
                <div class="flex justify-center mt-10">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg font-bold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
