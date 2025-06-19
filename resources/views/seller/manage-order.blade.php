<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders - Match Ya Skin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-white text-gray-900 font-sans">

<!-- Navbar -->
    <nav class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center space-x-2 text-xl font-bold text-blue-600">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12" />
        </div>
        <!-- Tabs -->
        <div class="flex gap-4 mb-6 border-b border-gray-200">
            <a href="{{ route('seller.products') }}"
            class="pb-2 border-b-2 {{ request()->routeIs('seller.products') ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-600 hover:text-blue-600' }}">
                Manage Products
            </a>
            <a href="{{ route('seller.orders') }}"
            class="pb-2 border-b-2 {{ request()->routeIs('seller.orders') ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-600 hover:text-blue-600' }}">
                Manage Orders
            </a>
        </div>

        {{-- Blade Auth Section --}}
        @if (Route::has('login'))
    <div class="ml-4 relative" x-data="{ open: false }">
        @auth
            <!-- Profile Icon Button -->
            <button @click="open = !open" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="w-8 h-8 text-gray-700 hover:text-blue-600 transition">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.away="open = false"
                 x-transition
                 class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-md z-50">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Account</a>
                   @if (Auth::user()->role === 'customer')
                        <a href="{{ route('user.orders') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Order</a>
                    @endif


                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Log in</a>
        @endauth
    </div>
@endif
    </nav>

<div class="max-w-7xl mx-auto px-6 py-10">
    @if (session('success'))
        <div class="mb-6 p-4 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('seller.orders') }}" class="flex flex-col md:flex-row gap-4 mb-6">
        {{-- Search by customer name --}}
        <input type="text" name="search" placeholder="Search by customer name"
            value="{{ request('search') }}"
            class="border border-gray-300 px-4 py-2 rounded w-full md:w-1/3 text-sm" />

        <!-- {{-- Filter by status --}}
        <select name="status" onchange="this.form.submit()"
        class="border border-gray-300 px-4 py-2 rounded w-full md:w-1/3 text-sm">
        <option value="">All Status</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option> -->
    </select>

    </form>




    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-gray-100 text-xs text-gray-600 uppercase">
                <tr>
                    <th class="px-4 py-3 border-b">Order ID</th>
                    <th class="px-4 py-3 border-b">Customer</th>
                    <th class="px-4 py-3 border-b">Product(s)</th>
                    <th class="px-4 py-3 border-b">Qty</th>
                    <th class="px-4 py-3 border-b">Total</th>
                    <th class="px-4 py-3 border-b">Status</th>
                    <th class="px-4 py-3 border-b">Payment Proof</th>
                    <th class="px-4 py-3 border-b text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3">#{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</td>
                    <!-- <td class="px-4 py-3">{{ $transaction->first_name }} {{ $transaction->last_name }}</td>-->
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-900">
                            {{ $transaction->first_name }} {{ $transaction->last_name }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $transaction->phone }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $transaction->address }}, {{ $transaction->address_detail }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $transaction->city }}, {{ $transaction->province }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $transaction->country }}, {{ $transaction->postal_code }}
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <ul class="list-disc list-inside text-sm text-gray-700">
                            @foreach ($transaction->items as $item)
                                <li>{{ $item->product->name ?? 'N/A' }} ({{ $item->quantity ?? '-' }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-4 py-3">{{ $transaction->items->sum('quantity') }}</td>
                    <td class="px-4 py-3">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        @php
                            $statusColor = match($transaction->status) {
                                'pending' => 'text-yellow-500',
                                'paid' => 'text-blue-600',
                                'shipped' => 'text-green-600',
                                'cancelled' => 'text-red-600',
                                default => 'text-gray-500'
                            };
                        @endphp
                        <span class="font-semibold {{ $statusColor }}">{{ ucfirst($transaction->status) }}</span>
                    </td>
                    <td class="px-4 py-3">
                        @if ($transaction->proof_of_payment)
                            <img src="{{ asset('storage/' . $transaction->proof_of_payment) }}"
                                alt="Proof"
                                class="h-12 w-12 object-cover rounded cursor-pointer border hover:scale-105 transition"
                                onclick="event.stopPropagation(); showModal('{{ asset('storage/' . $transaction->proof_of_payment) }}')" />
                        @else
                            <span class="text-gray-400 italic">No proof</span>
                        @endif
                    </td>

                    <td class="px-4 py-3 text-center">
                        @if ($transaction->status === 'pending')
                            <form method="POST" action="{{ route('seller.orders.confirm', $transaction->id) }}">
                                @csrf
                                <button class="text-green-600 font-bold hover:underline" title="Confirm">✔️ Confirm</button>
                            </form>

                            <!-- <form method="POST" action="{{ route('seller.orders.deny', $transaction->id) }}" style="display:inline; margin-left:10px;">
                                @csrf
                                <button class="text-red-600 font-bold hover:underline" title="Deny">❌ Deny</button>
                            </form> -->
                            <form method="POST" action="{{ route('seller.orders.deny', $transaction->id) }}" style="display:inline; margin-left:10px;"
                                onsubmit="return confirm('Are you sure you want to deny this order? This action cannot be undone.')">
                                @csrf
                                <button class="text-red-600 font-bold hover:underline" title="Deny">❌ Deny</button>
                            </form>

                        @elseif ($transaction->status === 'paid')
                            <form method="POST" action="{{ route('seller.orders.ship', $transaction->id) }}">
                                @csrf
                                <button class="text-blue-600 font-bold hover:underline" title="Ship">📦 Ship</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-gray-400 py-6">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Modal Preview -->
        <div id="imageModal" onclick="closeModal()"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div onclick="event.stopPropagation()" class="relative bg-white rounded-lg p-4 max-w-lg w-full shadow-lg">
                <button onclick="closeModal()"
                        class="absolute top-2 right-2 text-gray-500 hover:text-red-600 font-bold text-xl">×</button>
                <img id="modalImage" src="" alt="Preview" class="w-full h-auto rounded" />
            </div>
        </div>

    </div>

    <!-- Pagination -->
    <div class="mt-6 text-right">
        {{ $transactions->links() }}
    </div>
</div>
<script>
    function showModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalImage').src = '';
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>

</body>
</html>
