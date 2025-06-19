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
            <li><a href="#" class="text-blue-500 font-semibold">Products</a></li>
            <li><a href="{{ route('user.makeup') }}" class="hover:text-blue-600">My Makeup</a></li>
            <li><a href="{{ route('cart.view') }}" class="hover:text-blue-600">My Cart</a></li>
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

    <!-- Search Bar & Trending Header -->
<section class="text-center px-6 mt-12 mb-10">

    <h2 class="text-3xl md:text-4xl font-bold mb-10">Trending Now</h2>
</section>

<!-- Product Grid -->
<section class="text-center px-6 pb-20">
    <div class="flex flex-wrap justify-center gap-10">
        @forelse ($products as $product)
            <a href="{{ route('products.show', $product->id) }}"
               class="w-40 block hover:shadow-md transition-transform duration-200">
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="h-32 object-contain mx-auto mb-2" alt="{{ $product->name }}" />
                <p class="text-blue-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="font-bold">{{ $product->brand }}</p>
                <p class="text-sm text-gray-600">{{ $product->category }}</p>
                <div class="flex flex-col gap-1">
                    <p class="text-sm text-gray-600">{{ $product->sold_count ?? 0 }} sold</p>
                    <p class="text-sm text-blue-600 mt-1">
                        {!! str_repeat('★', floor($product->rating ?? 0)) !!}{{ str_repeat('☆', 5 - floor($product->rating ?? 0)) }}
                        {{ number_format($product->rating ?? 0, 1) }}
                    </p>
                </div>
            </a>
        @empty
            <p class="text-gray-500">No trending products found.</p>
        @endforelse
    </div>

    <div class="mt-10">
        <a href="{{ route('products.show') }}"
           class="border border-blue-600 text-blue-600 px-6 py-2 rounded hover:bg-blue-600 hover:text-white transition">
            VIEW ALL
        </a>
    </div>
</section>

<!-- Promotional Hero Banner -->
<section class="bg-gradient-to-br from-blue-100 via-blue-50 to-orange-50 py-12 px-6">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-10">
        <!-- Left Image -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <img src="{{ asset('images/sample.png') }}" alt="Clinique Product" class="h-72 mx-auto md:mx-0" />
        </div>

        <!-- Right Text -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">
                Best product for "your skin<br class="hidden md:block"> but better look"
            </h2>
            <p class="text-gray-700 mb-6">
                Want to try a natural look for your daily make up? Clinique Foundation with sheer but long-lasting
                ingredients is a must try choice!
            </p>
            <a href="{{ route('user.product') }}"
               class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                SHOP NOW
            </a>
        </div>
    </div>
</section>


<!-- Best Seller Section -->
<section class="bg-white py-16 px-6 text-center">
    <h2 class="text-2xl md:text-3xl font-bold mb-10">BEST SELLER</h2>

    <div class="flex flex-wrap justify-center gap-10">
        @forelse ($products as $product)
            <a href="{{ route('products.show', $product->id) }}"
               class="w-40 block hover:shadow-md transition-transform duration-200">
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="h-32 object-contain mx-auto mb-2" alt="{{ $product->name }}" />
                <p class="text-blue-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="font-bold">{{ $product->brand }}</p>
                <p class="text-sm text-gray-600">{{ $product->category }}</p>
                <div class="flex flex-col gap-1">
                    <p class="text-sm text-gray-600">{{ $product->sold_count ?? 0 }} sold</p>
                    <p class="text-sm text-blue-600 mt-1">
                        {!! str_repeat('★', floor($product->rating ?? 0)) !!}{{ str_repeat('☆', 5 - floor($product->rating ?? 0)) }}
                        {{ number_format($product->rating ?? 0, 1) }}
                    </p>
                </div>
            </a>
        @empty
            <p class="text-gray-500">No best seller products available.</p>
        @endforelse
    </div>

    <div class="mt-10">
        <a href="{{ route('products.show') }}"
           class="border border-blue-600 text-blue-600 px-6 py-2 rounded hover:bg-blue-600 hover:text-white transition">
            VIEW ALL
        </a>
    </div>
</section>

<!-- Promo Banner -->
    <section class="bg-pink-50 py-12 px-6">
        <div class="max-w-6xl mx-auto flex flex-col-reverse md:flex-row items-center justify-between gap-10">
            <!-- Left Text -->
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h2 class="text-2xl md:text-3xl font-bold mb-4 leading-snug">
                    JOIN US AND GET<br>10% OFF ON YOUR<br>FIRST PURCHASE
                </h2>
                <a href="{{ route('register') }}"
                   class="inline-block bg-white border border-gray-400 text-black px-6 py-2 rounded hover:bg-gray-200 transition">
                    SHOP NOW
                </a>
            </div>
            <!-- Right Image -->
            <div class="w-full md:w-1/2 text-center">
                <img src="{{ asset('images/banner-girl.png') }}" alt="Promo Girl" class="h-80 mx-auto" />
            </div>
        </div>
    </section>

    <!-- New Arrivals -->
<section class="bg-white py-16 px-6 text-center">
    <h2 class="text-2xl md:text-3xl font-bold mb-10">NEW ARRIVALS</h2>

    <div class="flex flex-wrap justify-center gap-10">
        @forelse ($newArrivals as $product)
            <a href="{{ route('products.show', $product->id) }}"
               class="w-40 block hover:shadow-md transition-transform duration-200">
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="h-32 object-contain mx-auto mb-2" alt="{{ $product->name }}" />
                <p class="text-blue-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="font-bold">{{ $product->brand }}</p>
                <p class="text-sm text-gray-600">{{ $product->category }}</p>
                <div class="flex flex-col gap-1">
                    <p class="text-sm text-gray-600">{{ $product->sold_count ?? 0 }} sold</p>
                    <p class="text-sm text-blue-600 mt-1">
                        {!! str_repeat('★', floor($product->rating ?? 0)) !!}{{ str_repeat('☆', 5 - floor($product->rating ?? 0)) }}
                        {{ number_format($product->rating ?? 0, 1) }}
                    </p>
                </div>
            </a>
        @empty
            <p class="text-gray-500">No new arrivals found.</p>
        @endforelse
    </div>

    <div class="mt-10">
        <a href="{{ route('products.show') }}"
           class="border border-blue-600 text-blue-600 px-6 py-2 rounded hover:bg-blue-600 hover:text-white transition">
            VIEW ALL
        </a>
    </div>
</section>


    <x-footer />
</body>
</html>
