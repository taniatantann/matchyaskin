<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Products - Match Ya Skin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-white text-gray-900 font-sans">

<!-- Navbar -->
    <nav class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center space-x-2 text-xl font-bold text-blue-600">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12" />
        </div>
        <!-- Tabs -->
    <div class="flex gap-6 mb-6 border-b border-gray-200 text-sm font-semibold">
        <a href="{{ route('seller.products') }}"
           class="pb-2 {{ request()->routeIs('seller.products') ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
            Manage Products
        </a>
        <a href="{{ route('seller.orders') }}"
           class="pb-2 {{ request()->routeIs('seller.orders') ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
            Manage Orders
        </a>
    </div>

        {{-- Blade Auth Section --}}
        @if (Route::has('login'))
    <div class="ml-4 relative" x-data="{ open: false }">
        @auth
            {{-- Profile Icon Button --}}
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
                   @if (Auth::user()->role === 'customer')
                        <a href="{{ route('user.orders') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Order</a>
                    @endif


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

<div class="max-w-7xl mx-auto px-6 py-10">
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif



    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('seller.products.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm font-medium">
            + Add Product
        </a>
    </div>

    <form method="GET" action="{{ route('seller.products') }}" class="flex flex-col md:flex-row gap-4 mb-6">
        {{-- Search by name or brand --}}
        <input type="text" name="search" placeholder="Search by name or brand"
            value="{{ request('search') }}"
            class="border border-gray-300 px-4 py-2 rounded w-full md:w-1/3 text-sm" />

        {{-- Filter by category --}}
        <select name="category" onchange="this.form.submit()"
            class="border border-gray-300 px-4 py-2 rounded w-full md:w-1/3 text-sm">
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

        {{-- Filter by stock --}}
        <select name="stock" onchange="this.form.submit()"
            class="border border-gray-300 px-4 py-2 rounded w-full md:w-1/3 text-sm">
            <option value="">All Stock</option>
            <option value="low" {{ request('stock') === 'low' ? 'selected' : '' }}>Low</option>
        </select>
    </form>





    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full text-sm text-left bg-white">
            <thead class="bg-gray-100 text-gray-600 uppercase">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Image</th>
                    <th class="px-4 py-3">Brand</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3 hidden md:table-cell">Stock</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $product->id }}</td>
                        <td class="px-4 py-3">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="h-10 w-10 object-cover rounded" alt="{{ $product->name }}">
                            @else
                                <span class="text-gray-400 italic">No image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $product->brand }}</td>
                        <td class="px-4 py-3">{{ $product->name }}</td>
                        <td class="px-4 py-3">{{ $product->category }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 hidden md:table-cell">{{ $product->stock ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('seller.products.edit', $product) }}"
                               class="text-yellow-500 hover:text-yellow-700 text-lg">✏️</a>
                            <form action="{{ route('seller.products.destroy', $product) }}" method="POST"
                                  class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-lg ml-1">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center py-6 text-gray-500">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>

</body>
</html>
