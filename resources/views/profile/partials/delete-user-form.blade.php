<section class="space-y-6 bg-white text-black">
    <header>
        <h2 class="text-lg font-medium text-black">
            Delete Account
        </h2>

        <p class="mt-1 text-sm text-black">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <button
        onclick="document.getElementById('confirm-user-deletion').classList.remove('hidden')"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
    >
        Delete Account
    </button>

    <!-- Modal -->
    <div id="confirm-user-deletion" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <h2 class="text-lg font-medium text-black mb-2">
                    Are you sure you want to delete your account?
                </h2>

                <p class="text-sm text-black mb-4">
                    Once your account is deleted, all of its resources and data will be permanently deleted.
                    Please enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-black">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Password"
                    >
                    @if ($errors->userDeletion->has('password'))
                        <p class="text-sm text-red-600 mt-1">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <div class="flex justify-end space-x-3">
                    <button
                        type="button"
                        onclick="document.getElementById('confirm-user-deletion').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100"
                    >
                        Cancel
                    </button>

                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
