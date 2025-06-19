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
            <li><a href="#" class="text-blue-500">Home</a></li>
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
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Log in</a>
        @endauth
    </div>
@endif
    </nav>

    <!-- Hero -->
    <section class="text-center px-6 mt-12 mb-16">
        <h1 class="text-5xl font-bold leading-snug">Get the most suitable<br>products for your skin</h1>
    </section>

    <!-- Features -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-10 px-6 mb-16 max-w-5xl mx-auto text-center">
        <div>
            <img src="https://img.icons8.com/ios/100/000000/task.png" class="mx-auto mb-4 h-14" />
            <h3 class="text-lg font-semibold mb-1">Free Skin Type Test</h3>
            <p class="text-gray-600 text-sm">We offer a free test to determine your personal skin type.</p>
        </div>
       <div>
            <img src="{{ asset('images/hom.png') }}" class="mx-auto mb-4 h-14" />
            <h3 class="text-lg font-semibold mb-1">Personalized Product</h3>
            <p class="text-gray-600 text-sm">We list recommended products suitable for your unique skin type</p>
        </div>
        <div>
            <img src="https://img.icons8.com/ios/100/000000/thumb-up--v1.png" class="mx-auto mb-4 h-14" />
            <h3 class="text-lg font-semibold mb-1">Real Reviews</h3>
            <p class="text-gray-600 text-sm">We collect honest reviews from users who actually tried the products</p>
        </div>
    </section>

    <!-- Skin Types -->
    <section class="bg-gray-100 py-6 px-4">
        <div class="flex overflow-x-auto gap-6 justify-center">
            <img src="{{ asset('images/Acne.png') }}" class="h-30" />
            <img src="{{ asset('images/2.png') }}" class="h-30" />
            <img src="{{ asset('images/3.png') }}" class="h-30" />
            <img src="{{ asset('images/4.png') }}" class="h-30" />
            <img src="{{ asset('images/5.png') }}" class="h-30" />
        </div>
    </section>
    <!-- Skin Type Section -->
<section class="text-center px-6 py-16">
  <h2 class="text-3xl md:text-4xl font-bold mb-10">Learn your skin type now</h2>

  <div class="max-w-3xl mx-auto bg-orange-100 p-6 rounded-tl-[100px]">
    <p class="text-gray-700 mb-6 text-right">
      Using the combination of Fitzpatrick Scale and Baumann Skin Type Test, we will provide a more accurate and personalized analysis of your skin. By understanding your skin's sensitivity to sunlight and its distinctive characteristics, we can help you choose the right cosmetic products for your skin. Take this free personal test to discover what truly suits your skin.
    </p>

    <a href="{{ route('user.makeup') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition">
      Start the test
    </a>
  </div>
</section>


<!-- Best Product Section -->
<section class="text-center px-6 pb-20">
  <h2 class="text-3xl md:text-4xl font-bold mb-10">Find the best product</h2>

  @foreach ($products->take(10)->chunk(5) as $chunk)
    <div class="flex flex-wrap justify-center gap-8 mb-8">
      @foreach ($chunk as $product)
        <a href="{{ route('products.detail', $product->id) }}"
           class="w-40 hover:shadow-md transition-transform duration-200">
          <img src="{{ asset('storage/' . $product->image) }}" class="h-32 object-contain mx-auto" alt="{{ $product->name }}" />
          <p class="text-blue-600 font-semibold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
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
      @endforeach
    </div>
  @endforeach

  <div class="mt-10">
    <a href="{{ route('products.show') }}"
       class="border border-blue-600 text-blue-600 px-6 py-2 rounded hover:bg-blue-600 hover:text-white transition">
      VIEW ALL
    </a>
  </div>
</section>




</body>
</html>
<x-footer />
