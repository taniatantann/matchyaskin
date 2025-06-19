<section class="bg-white text-black">
    <header>
        <h2 class="text-lg font-medium text-black">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-black">
            Update your account's profile information and email address.
        </p>
    </header>

    <!-- Form Kirim Ulang Verifikasi -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Form Update Profile -->
    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-black">Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
            />
            @if ($errors->has('name'))
                <p class="text-sm text-red-600 mt-1">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-black">Email</label>
            <!-- <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
            /> -->
            <input
                type="email"
                id="email"
                value="{{ old('email', $user->email) }}"
                disabled
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
            />


            @if ($errors->has('email'))
                <p class="text-sm text-red-600 mt-1">{{ $errors->first('email') }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-black">
                        Your email address is unverified.
                        <button
                            form="send-verification"
                            class="underline text-sm text-blue-600 hover:text-blue-800 focus:outline-none"
                        >
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-black"
                >
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>
