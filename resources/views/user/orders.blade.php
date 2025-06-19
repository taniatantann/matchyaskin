
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Match Ya Skin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

</head>
<body class="bg-white text-gray-900 font-sans">
<!-- Navbar -->
    <nav class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center space-x-2 text-xl font-bold text-blue-600">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12" />
        </div>
       <ul class="flex items-center space-x-6 text-sm font-medium">
            <li><a href="{{ url('/') }}" class="hover:text-blue-600">Home</a></li>
            <li><a href="{{ route('products.show') }}" class="hover:text-blue-600">Products</a></li>
            <li><a href="{{ route('user.makeup') }}" class="hover:text-blue-600">My Makeup</a></li>
            <li><a href="{{ route('cart.view') }}" class="text-blue-500 font-semibold">My Cart</a></li>
        </ul>

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
                   <a href="{{ route('user.orders') }}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Order</a>

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

<div class="max-w-5xl mx-auto px-4 py-10">
    <h2 class="text-xl font-bold mb-6 border-b pb-2">My Order</h2>

    <table class="w-full border text-sm">
    <thead class="bg-gray-100 text-gray-600">
        <tr>
            <th class="px-4 py-2 text-left">Product</th>
            <th class="px-4 py-2 text-center">Total</th>
            <th class="px-4 py-2 text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr class="border-t">
                <td class="px-4 py-3">
                    @foreach ($transaction->items as $item)
                        <div class="flex gap-3 mb-2">
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="w-10 h-10 object-cover border rounded">
                            <div>
                                <div class="font-semibold">{{ $item->product->brand }}</div>
                                <div class="text-gray-500 text-sm">{{ $item->product->category }}</div>
                                <!-- <div class="text-xs text-gray-500">Shade: {{ $item->shade ?? '-' }}</div> -->
                                <div class="text-xs text-gray-700">Qty: x{{ $item->quantity }}</div>
                            </div>
                        </div>
                    @endforeach
                </td>

                <td class="px-4 py-3 text-center font-semibold text-gray-800">
                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                </td>
                <td class="px-4 py-3 text-center">
                    @if ($transaction->status === 'pending')
                        <span class="text-blue-600 font-medium">Waiting for confirmation</span>
                    @elseif ($transaction->status === 'paid')
                        <span class="text-red-500">Shipped</span>
                    @elseif ($transaction->status === 'shipped')
                         <button onclick="markSuccess({{ $transaction->id }})"
                            class="border border-blue-400 px-3 py-1 rounded text-blue-600 text-sm">
                            Order Received
                        </button>
                    @elseif ($transaction->status === 'success')
                        <span class="text-green-600 font-medium">Completed</span>
                    @elseif ($transaction->status === 'cancelled')
                        <span class="text-red-500">Cancelled</span>
                    @else
                        <span class="text-gray-500 capitalize">{{ $transaction->status }}</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-lg w-full relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-xl text-blue-500 font-bold">×</button>
        <h2 class="text-xl font-bold text-center text-blue-600">Loving your new product?</h2>
        <p class="text-gray-500 text-center text-sm mb-4">Please give your rating and review to help others choosing the right product</p>

        <form id="reviewForm" method="POST">
            @csrf
            <div class="flex justify-center mb-4" id="stars">
                @for ($i = 1; $i <= 5; $i++)
                    <svg data-star="{{ $i }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor"
                         class="w-8 h-8 text-yellow-400 cursor-pointer hover:scale-105 transition">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M11.48 3.5l1.07 3.29h3.46l-2.8 2.03 1.07 3.29L11.48 10.1l-2.8 2.03 1.07-3.29-2.8-2.03h3.46l1.07-3.29z" />
                    </svg>
                @endfor
            </div>
            <input type="hidden" name="rating" id="rating" value="0">

            <div class="mb-4">
                <label class="block font-semibold mb-1">Review</label>
                <textarea name="review" rows="3"
                          class="w-full border px-4 py-2 rounded" placeholder="Write here..."></textarea>
            </div>
            <div class="text-center">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    SUBMIT
                </button>
            </div>
        </form>
    </div>
</div>


</div>

<x-footer />

<script>
    let currentTransactionId = null;

    function markSuccess(transactionId) {
        fetch(`/user/order/${transactionId}/complete`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        }).then(res => res.json())
          .then(data => {
              currentTransactionId = transactionId;
              document.getElementById('reviewForm').action = `/user/order/${transactionId}/review`;
              openModal();
          });
    }

    function openModal() {
        document.getElementById('reviewModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('reviewModal').classList.add('hidden');
    }

    document.querySelectorAll('#stars svg').forEach(star => {
        star.addEventListener('click', function () {
            const val = this.getAttribute('data-star');
            document.getElementById('rating').value = val;

            document.querySelectorAll('#stars svg').forEach(s => {
                s.classList.remove('fill-yellow-400');
            });

            for (let i = 0; i < val; i++) {
                document.querySelectorAll('#stars svg')[i].classList.add('fill-yellow-400');
            }
        });
    });
</script>

</body>
</html>
