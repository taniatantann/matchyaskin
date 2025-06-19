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

<div id="question-section" class="min-h-screen flex items-center justify-center bg-[#e99db1] py-12 px-4">
    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-2xl">
        <!-- Step Progress -->
        <div class="flex justify-between items-center mb-6">
            <div class="text-sm font-semibold text-gray-700">Pertanyaan {{ $step }} dari 61</div>
            <div class="text-xs text-blue-500 font-semibold">Baumann indicator</div>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-6">
            <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ ($step / 61) * 100 }}%"></div>
        </div>

        <!-- Question -->
        <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $question }}</h2>

        <!-- Form -->
        <form action="{{ route('user.baumann.step.store', ['step' => $step]) }}" method="POST">
            @csrf
            <div class="space-y-3">
                @foreach ($options as $key => $option)
                    <label class="block">
                        <input type="radio" name="answer" value="{{ $option }}" class="sr-only peer" required>
                        <div class="peer-checked:bg-blue-500 peer-checked:text-white bg-white border border-gray-300 rounded px-4 py-2 cursor-pointer hover:bg-gray-100">
                            {{ $option }}
                        </div>
                    </label>
                @endforeach
            </div>

            <!-- Navigation -->
            <div class="flex justify-between mt-6">
                @if ($step > 1)
                    <a href="{{ route('user.baumann.step', ['step' => $step - 1]) }}"
                       class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                        Sebelumnya
                    </a>
                @else
                    <span></span>
                @endif

                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Lanjut
                </button>
            </div>
        </form>
    </div>
</div>



<x-footer />

<!-- supaya bagian yang pink gak gerak2 -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.location.hash = '#question-section';
    });
</script>


</body>
</html>
