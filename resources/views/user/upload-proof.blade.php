
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
            <li><a href="{{ route('products.show') }}" class="text-blue-500 font-semibold">Products</a></li>
            <li><a href="{{ route('user.makeup') }}" class="hover:text-blue-600">My Makeup</a></li>
            <li><a href="#" class="hover:text-blue-600">My Cart</a></li>
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

  <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-10">
        <h2 class="text-xl font-bold mb-6 border-b pb-2">Upload Proof of Payment</h2>

        <div class="text-sm space-y-2 mb-6">
            <div class="grid grid-cols-[auto_1fr] gap-x-1">
                <p class="font-semibold">Contact:</p>
                <p class="ml-16">{{ $transaction->user->name }}</p>
            </div>
            <div class="grid grid-cols-[auto_1fr] gap-x-1">
                <p class="font-semibold">Phone Number:</p>
                <p class="ml-[18px]">{{ $transaction->phone ?? '-' }}</p>
            </div>
            <div class="grid grid-cols-[auto_1fr] gap-x-1">
                <p class="font-semibold">Address:</p>
                <p class="ml-16">{{ $transaction->address ?? '-' }}</p>
            </div>
            <div class="grid grid-cols-[auto_1fr] gap-x-1">
                <p class="font-semibold">Total Amount:</p>
                <p class="ml-[30px]">Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
            </div>
        
            <p class="text-red-600 font-semibold text-sm leading-relaxed mt-2 text-center ml-10 mr-10">
                *After checking the contact details above, please transfer the Total Amount to the bank account below and upload the proof of payment.
            </p>
        
            <div class="mt-2">
                <p><strong>Transfer to:</strong></p>
                <p class="text-sm font-semibold ml-4">604 1393 112 - Bank BCA - Match ya Skin</p>
            </div>
        </div>

        <form action="{{ route('transaction.proof.submit', $transaction->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Proof of Payment *</label>
                <input type="file" name="proof" required class="block border rounded w-full px-3 py-2" />
            </div>
            <div class="pt-4">
                <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-6 py-2 rounded hover:bg-blue-700 transition">
                    SUBMIT
                </button>
            </div>
        </form>
    </div>

<x-footer />
</body>
</html>
