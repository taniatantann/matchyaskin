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
            <li><a href="#" class="text-blue-500 font-semibold">My Makeup</a></li>
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

    <div id="question-section" class="min-h-screen flex items-center justify-center" style="background-color: #e99db1;">
        <div class="text-center px-6 py-12 max-w-xl">
            <!-- Lingkaran Nomor -->
            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-[#c1d8f0] shadow-md flex items-center justify-center">
                <span class="text-2xl font-bold text-white drop-shadow">1</span>
            </div>

            <!-- Judul -->
            <h1 class="text-white text-2xl md:text-3xl font-bold mb-4">Fitzpatrick Scale Quiz</h1>

            <!-- Deskripsi -->
            <p class="text-white text-sm md:text-base font-light leading-relaxed mb-6">
                This quiz is used to determine your skin sensitivity of the UV; how likely it is for you to get sunburned and the recommended SPF dosage you will need to protect your skin.
            </p>

            <!-- Tombol -->
            <a href="{{ route('user.quiz.step', ['step' => 1]) }}"
            class="bg-white text-black font-semibold text-sm md:text-base px-6 py-2 rounded-md hover:bg-gray-100 transition">
                START NOW
            </a>
        </div>
    </div>

<x-footer />
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.location.hash = '#question-section';
    });
</script>
</body>
</html>
