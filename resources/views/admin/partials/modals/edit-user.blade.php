<div id="editUserModal" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden items-center justify-center px-4">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-lg animate-fade-in relative">
        <button onclick="toggleEditModal(false)"
                class="absolute top-3 right-4 text-gray-500 hover:text-gray-700 text-xl font-bold">
            &times;
        </button>
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit User</h2>
        <form method="POST" id="editUserForm" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input name="name" id="edit-user-name" type="text" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input name="email" id="edit-user-email" type="email" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                <select name="role" id="edit-user-role" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="customer">Customer</option>
                    <option value="seller">Seller</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-full transition-all">
                Save Changes
            </button>
        </form>
    </div>
</div>
