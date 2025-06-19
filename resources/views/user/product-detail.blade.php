<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $product->brand }} - Product Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

</head>
<body class="bg-white text-gray-900 font-sans">
@if (session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

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

<!-- Product Detail Section -->
<section class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row gap-10 items-start">
        <!-- Product Image -->
        <div class="w-full md:w-1/2 text-center">
            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="h-80 object-contain mx-auto" />
        </div>

        <!-- Product Info -->
        <div class="w-full md:w-1/2">
            <h1 class="text-3xl font-bold mb-4">{{ $product->brand }}</h1>
            <p class="text-sm text-gray-600 mb-2">{{ $product->category }}</p>
            <p class="text-blue-600 font-semibold text-xl mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-sm font-bold text-blue-600 mb-2">Description</p>
            <p class="text-sm text-gray-600 mb-2">{{ $product->description }}</p>
            <!-- ingredients pakai Dropdown -->
            <!-- <div x-data="{ open: false }" class="mt-4">
                <button @click="open = !open" type="button"
                    class="flex items-center justify-between w-full text-left text-sm font-bold text-gray-700 mb-1 hover:text-blue-600">
                    Ingredients
                    <svg x-show="!open" class="w-4 h-4 ml-2 transform rotate-0 transition-transform duration-200"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                    <svg x-show="open" class="w-4 h-4 ml-2 transform rotate-180 transition-transform duration-200"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-transition class="text-sm text-gray-600 mt-1">
                    {{ $product->ingredients }}
                </div>
            </div> -->

            <!-- ingredients pakai "See More" -->
            @php
                $maxChars = 120;
                $ingredientsPreview = Str::limit($product->ingredients, $maxChars, '');
                $isLong = strlen($product->ingredients) > $maxChars;
            @endphp

            <div x-data="{ expanded: false }" class="mt-4">
                <p class="text-sm font-bold text-blue-600 mb-1">Ingredients</p>
                <p class="text-sm text-gray-600">
                    <span x-show="!expanded">
                        {{ $ingredientsPreview }}@if($isLong)...@endif
                        @if($isLong)
                            <button @click="expanded = true" class="text-blue-600 text-sm ml-1 hover:underline">See more</button>
                        @endif
                    </span>
                    <span x-show="expanded" x-transition>
                        {{ $product->ingredients }}
                        <button @click="expanded = false" class="text-blue-600 text-sm ml-1 hover:underline">See less</button>
                    </span>
                </p>
            </div>

            <br>

            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                @csrf
                <div class="flex items-center gap-3 mt-6">
                    <input type="number" name="quantity" value="1" min="1"
                        class="w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" />
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Add to Cart
                    </button>
                </div>
            </form>

        </div>
    </div>
</section>
<!-- Ratings and Reviews Section -->
<section class="max-w-6xl mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Customer Reviews</h2>

    @if($product->reviews->count() > 0)
        @foreach ($product->reviews as $review)
            <div class="border border-gray-200 rounded p-4 mb-4 bg-gray-50">
                <div class="flex items-center justify-between mb-2">
                    <div class="font-semibold text-gray-700">{{ $review->user->name ?? 'Anonymous' }}</div>
                    <div class="text-yellow-500">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                </div>
                <p class="text-gray-600 text-sm">{{ $review->review }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $review->created_at->format('d M Y') }}</p>
            </div>
        @endforeach
    @else
        <p class="text-sm text-gray-600">No reviews yet for this product.</p>
    @endif
</section>


<x-footer />
</body>
</html>
