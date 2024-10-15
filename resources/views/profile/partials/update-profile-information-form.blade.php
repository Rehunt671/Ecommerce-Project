<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        
        <!-- Profile Picture Upload -->
        <div class="w-60 h-80 mt-5 border-2 border-gray-300 rounded-lg flex items-center justify-center text-gray-500 mb-4 relative cursor-pointer" onclick="document.getElementById('profile_picture').click();">
            <input type="file" name="profile_picture" accept="image/*" class="hidden" id="profile_picture" onchange="previewImage(event)">

            <!-- If user already has an image, display it, otherwise show the upload text -->
            @if (Auth::user()->image_name)
                <img src="{{ asset('storage/' . Auth::user()->image_name) }}" id="image_preview" class="w-full h-full object-cover rounded-lg" />
            @else
                <span id="upload_text">Add Picture</span>
                <img src="" id="image_preview" class="hidden w-full h-full object-cover rounded-lg" />
            @endif
        </div>

        <!-- Name Input -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email Input -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Phone Input -->
        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autofocus autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <!-- Location Input -->
        <div>
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $user->location)" required autocomplete="address-level2" />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
                <script>
                    window.addEventListener('DOMContentLoaded', () => {
                        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'profile-updated' }));
                    });
                </script>
            @endif
        </div>
    </form>

    <!-- JavaScript for Image Preview -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const imagePreview = document.getElementById('image_preview');
            const uploadText = document.getElementById('upload_text');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadText.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                imagePreview.classList.add('hidden');
                uploadText.classList.remove('hidden');
            }
        }
    </script>
</section>


