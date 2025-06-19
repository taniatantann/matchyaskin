<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Match Ya Skin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>

        .select2-container--default .select2-selection--single {
            height: 100%;
            padding-top: 0.2rem;
            border-color: rgb(209 213 219 / var(--tw-border-opacity, 1));
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow{
            top: 6px;
        }

    </style>
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

    <section class="text-center px-6 mt-12 mb-10">
    <form method="GET" action="{{ route('products.show') }}" class="mb-6 flex flex-wrap justify-center gap-4">

        {{-- Search by name or brand --}}
        <div class="relative w-full md:w-1/3">
            <input type="text" name="search" id="search" placeholder="Search by name or brand"
                value="{{ request('search') }}"
                class="border border-gray-300 px-4 py-2 rounded w-full text-sm"
                autocomplete="off" />

            {{-- Suggestions dropdown --}}
            <div id="suggestions"
                class="absolute z-50 bg-white border border-gray-300 w-full rounded mt-1 hidden max-h-60 overflow-y-auto text-left">
                <!-- hasil AJAX ditaro disini -->
            </div>
        </div>

        {{-- Filter by category --}}
        <select name="category" onchange="this.form.submit()" id="categories"
            class="border border-gray-300 px-4 py-2 rounded w-full md:w-1/4 text-sm">
            <option value="">All Categories</option>
            @foreach([
                'Tinted Moisturizer', 'Foundation', 'BB & CC Cream', 'Cushion', 'Concealer',
                'Powder', 'Bronzer', 'Primer', 'Highlighter', 'Contour', 'Blush',
                'Eyeliner', 'Mascara', 'Eyeshadow', 'Eyebrows', 'Lipstick', 'Lip Liner',
                'Lipstain & Tint', 'Lip Balm', 'Lip Gloss', 'Cleanser', 'Moisturizer', 'Toner', 'Sunscreen'
            ] as $cat)
                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>

    </form>

    <h2 class="mt-10 text-3xl md:text-4xl font-bold">Our Products</h2>
</section>



<section class="px-6 pb-20 max-w-7xl mx-auto">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-items-center">
        @forelse ($products as $product)
            <a href="{{ route('products.detail', $product->id) }}"
               class="w-full max-w-[160px] hover:shadow-md transition-transform duration-200 text-center">
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
            <p class="col-span-full text-gray-500">No products available.</p>
        @endforelse
    </div>

    <div class="px-20 mt-10">
        {{ $products->links() }}
    </div>
</section>

<x-footer />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function () {
    // opt: debounce sederhana buat hindarin server kebanyakan request
    $('#categories').select2();
    let debounce;
    $('#search').on('input', function () {
        clearTimeout(debounce);

        const query = $(this).val().trim();      // hapus spasi di awal/akhir
        if (query.length >= 1) {                 // ubah > jadi >=
            debounce = setTimeout(() => {        // opt: 300 ms debounce
                $.ajax({
                    url: "{{ route('products.suggestions') }}",
                    type: "GET",
                    data: { query },
                    success: function (data) {
                        const suggestions = $('#suggestions');
                        suggestions.empty().removeClass('hidden');

                        if (data.length) {
                            data.forEach(item => {
                                suggestions.append(`
                                    <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer suggestion-item"
                                         data-brand="${item.brand}"
                                         data-name="${item.name}">
                                         <strong>${item.brand}</strong> – ${item.name}
                                    </div>
                                `);
                            });
                        } else {
                            suggestions.append('<div class="px-4 py-2 text-gray-500">No results</div>');
                        }
                    }
                });
            }, 300);
        } else {
            $('#suggestions').addClass('hidden').empty(); // biar suggestion gk muncul kalau input kosonng
        }
    });

    // spy setiap suggestion bisa di klik
    $(document).on('click', '.suggestion-item', function () {
        const name = $(this).data('name');
        $('#search').val(name);
        $('#suggestions').addClass('hidden').empty();
        $('#search').closest('form').submit();   // auto submit
    });

    // umpetin suggestion dropdown kalau klik di luar
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#search, #suggestions').length) {
            $('#suggestions').addClass('hidden').empty();
        }
    });
});
</script>


</body>
</html>
