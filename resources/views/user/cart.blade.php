<!-- @php
    $shipping = 9000;
    $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
    $total = $subtotal + $shipping;
@endphp -->
@php
    $shipping = $cartItems->isNotEmpty() ? 9000 : 0;
    $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
    $total = $subtotal + $shipping;
@endphp

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
            <li><a href="#" class="text-blue-500 font-semibold">My Cart</a></li>
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

<div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 mt-10 mb-10">
    <!-- Cart List -->
    <div class="md:col-span-2 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold border-b pb-3 mb-6">My Cart</h2>

        <!-- Table Header -->
        <div class="grid grid-cols-6 gap-2 text-xs font-semibold text-gray-500 border-b pb-2">
            <div class="col-span-2">Products</div>
            <div>Price</div>
            <div>Qty</div>
            <div>Total</div>
        </div>

        <!-- Cart Items -->
        @forelse ($cartItems as $item)
            <div class="grid grid-cols-6 gap-2 items-center py-4 border-b">
                <div class="col-span-2 flex items-center gap-4">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->brand }}"
                         class="h-16 w-16 object-contain">
                    <div>
                        <p class="font-semibold text-sm">{{ $item->product->brand }}</p>
                        <p class="text-xs text-gray-500">{{ $item->product->category }}</p>
                    </div>
                </div>

                <div class="text-sm">Rp {{ number_format($item->product->price, 0, ',', '.') }}</div>
                <div class="flex items-center justify-center gap-2">
                    <form action="{{ route('cart.decrease', $item->id) }}" method="POST">
                        @csrf
                        <button class="px-2 border rounded text-gray-600">-</button>
                    </form>
                    
                    <span>{{ $item->quantity }}</span>

                    <form action="{{ route('cart.increase', $item->id) }}" method="POST">
                        @csrf
                        <button class="px-2 border rounded text-gray-600">+</button>
                    </form>
                </div>

                <div class="text-sm">
                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 text-xs hover:underline mt-1">Remove</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="py-4 text-gray-500">Your cart is empty.</p>
        @endforelse
    </div>

    <!-- Order Summary -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-bold mb-4">Order Summary</h2>
        <div class="text-sm space-y-2">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            @if ($cartItems->isNotEmpty())
                <div class="flex justify-between">
                    <span>Shipping</span>
                    <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                </div>
            @endif

            <div class="flex justify-between font-bold border-t pt-2">
                <span>TOTAL</span>
                <span class="text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>

        <a href="{{ route('checkout.form') }}"
        class="mt-6 block w-full bg-blue-600 text-white text-center font-semibold py-2 rounded hover:bg-blue-700 transition">
            CHECKOUT
        </a>
    </div>
</div>

<x-footer />
</body>
</html>
