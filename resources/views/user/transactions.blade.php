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

    @if (Route::has('login'))
        <div class="ml-4 relative" x-data="{ open: false }">
            @auth
                <button @click="open = !open" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="w-8 h-8 text-gray-700 hover:text-blue-600 transition">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false"
                     x-transition
                     class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-md z-50">
                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Account</a>
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

<!-- Header -->
<section class="text-center px-6 mt-12 mb-10">
    <input type="text" placeholder="Search products..."
           class="w-full max-w-xl px-4 py-2 border border-blue-400 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-300 mb-6" />
    <h2 class="text-3xl md:text-4xl font-bold">Our Recommendation</h2>
    <p class="mt-2 text-sm text-gray-600">
        Fitzpatrick Scale – {{ $fitzType }} &amp; Baumann Indicator – {{ $baumannType }}
    </p>
</section>

<!-- Product Grid -->
<section class="px-6 pb-20 max-w-7xl mx-auto">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-items-center">
        @forelse ($products as $product)
            <a href="{{ route('products.detail', $product->id) }}"
               class="w-full max-w-[160px] hover:shadow-md transition-transform duration-200 text-center">
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="h-32 object-contain mx-auto mb-2 rounded" alt="{{ $product->product_name }}" />
                <p class="text-blue-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="font-bold">{{ $product->brand }}</p>
                <p class="text-sm text-gray-600">{{ $product->category }}</p>
                <!-- <div class="text-sm text-blue-600 mt-1">★★★★☆ {{ number_format($product->rating ?? 4.0, 1) }}</div> -->
                <p class="text-sm text-blue-600 mt-1">
            {!! str_repeat('★', floor($product->rating ?? 0)) !!}{{ str_repeat('☆', 5 - floor($product->rating ?? 0)) }}
            {{ number_format($product->rating ?? 0, 1) }}
        </p>

                <div class="flex flex-wrap justify-center gap-1 mt-1">
                    @if ($product->alcohol_free)
                        <span class="text-xs border border-blue-500 text-blue-600 px-2 py-1 rounded-full">Non-Alcohol</span>
                    @endif
                    @if ($product->perfume_free)
                        <span class="text-xs border border-blue-500 text-blue-600 px-2 py-1 rounded-full">Non-Perfume</span>
                    @endif
                    @if ($product->essential_oil_free)
                        <span class="text-xs border border-blue-500 text-blue-600 px-2 py-1 rounded-full">No Essential Oil</span>
                    @endif
                    @if ($product->paraben_free)
                        <span class="text-xs border border-blue-500 text-blue-600 px-2 py-1 rounded-full">Paraben-Free</span>
                    @endif
                </div>
            </a>
        @empty
            <p class="col-span-full text-gray-500">No products available.</p>
        @endforelse
    </div>

    @if (method_exists($products, 'links'))
        <div class="mt-10 flex justify-center">
            {{ $products->links() }}
        </div>
    @endif
</section>

<x-footer />
</body>
</html>
