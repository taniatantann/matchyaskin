<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About - Match Ya Skin</title>
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
            <li><a href="{{ url('/') }}" class="over:text-blue-600">Home</a></li>
          <li><a href="{{ route('products.show') }}" class="hover:text-blue-600">Products</a></li>
            <li><a href="{{ route('user.makeup') }}">My Makeup</a></li>
            <li><a href="{{ route('cart.view') }}">My Cart</a></li>
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
            <a href="{{ route('login') }}" class="font-semibold text-black hover:text-gray-900">Log in</a>
        @endauth
    </div>
@endif
    </nav>

<!-- Hero Section -->
<section class="pt-8 pb-12 px-6">
    <div class="max-w-6xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Left: Image -->
        <div>
            <img src="{{ asset('images/about1.png') }}" alt="About Match ya Skin" class="w-full h-auto rounded-lg shadow-md">
        </div>
        <!-- Right: Text -->
        <div class="text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-4">
                Welcome to <br><span class="text-4xl md:text-5xl text-black">Match ya Skin!</span>
            </h1>
            <p class="text-lg text-gray-700 leading-relaxed">
                We believe that skincare and cosmetics should be as unique as you are.
                Our mission is to help you discover the most suitable facial cosmetics by
                understanding your true skin needs. Not just following trends.
            </p>
        </div>
    </div>
</section>

<!-- Informative Section -->
<section class="bg-white text-center px-6 py-12">
    <p class="text-lg text-gray-800 max-w-4xl mx-auto leading-relaxed">
        We use two trusted dermatological frameworks:
        <a href="#" class="text-blue-600 underline hover:text-blue-800">The Fitzpatrick Scale</a>,
        which assesses how your skin reacts to the sun, and
        <a href="#" class="text-blue-600 underline hover:text-blue-800">The Baumann Skin Type Indicator</a>,
        which identifies your skin type based on oiliness, sensitivity, pigmentation, and aging.
        By combining these insights, we recommend products that truly match your skin’s profile.
    </p>
</section>

<!-- Dual Column Section with Image + Text -->
<section class="bg-white px-6 py-12">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Left: Flower + Text -->
        <div class="text-center md:text-left">
            <img src="{{ asset('images/about2.png') }}" alt="Flowers" class="mb-6 mx-auto md:mx-0 w-64 md:w-80" />
            <p class="text-gray-800 text-base leading-relaxed max-w-md mx-auto md:mx-0">
                Whether you’re just starting your skincare journey or looking for better product options,
                our free skin personality tests and personalized product suggestions are designed to guide
                you every step of the way.
            </p>
        </div>
        <!-- Right: Skincare Woman Image -->
        <div>
            <img src="{{ asset('images/about3.png') }}" alt="Applying Cream" class="rounded-lg shadow-md w-full h-auto" />
        </div>
    </div>
</section>

<!-- Final Call-to-Value Section -->
<section class="bg-white text-center px-6 py-12">
    <p class="text-base md:text-lg text-gray-800 mb-4">
        We’re here to make skincare
        <span class="text-blue-600 font-medium">smarter</span>,
        more <span class="text-blue-600 font-medium">personal</span>,
        and <span class="text-blue-600 font-medium">easier</span> for everyone.
    </p>
    <h2 class="text-2xl md:text-4xl font-extrabold text-gray-900 leading-snug">
        Let’s <span class="underline">find the right <span class="font-bold">match, for ya skin.</span></span>
    </h2>
</section>


    <!-- Footer -->
    <x-footer />
</body>
</html>
