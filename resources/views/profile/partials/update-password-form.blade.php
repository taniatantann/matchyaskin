<section class="bg-white text-black">
    <header>
        <h2 class="text-lg font-medium text-black">
            Update Password
        </h2>

        <p class="mt-1 text-sm text-black">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-black">Current Password</label>
            <input
                id="current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
            />
            @if ($errors->updatePassword->has('current_password'))
                <p class="text-sm text-red-600 mt-1">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <!-- New Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-black">New Password</label>
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
            />
            @if ($errors->updatePassword->has('password'))
                <p class="text-sm text-red-600 mt-1">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-black">Confirm Password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
            />
            @if ($errors->updatePassword->has('password_confirmation'))
                <p class="text-sm text-red-600 mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save
            </button>

            @if (session('status') === 'password-updated')
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
