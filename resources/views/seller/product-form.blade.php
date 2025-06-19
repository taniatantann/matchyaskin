<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($product) ? 'Edit Product' : 'Add Product' }} - Match Ya Skin</title>
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
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
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

<div class="max-w-3xl mx-auto px-6 py-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            {{ isset($product) ? 'Edit Product' : 'Add New Product' }}
        </h2>

        <form method="POST" enctype="multipart/form-data"
              action="{{ isset($product) ? route('seller.products.update', $product) : route('seller.products.store') }}">
            @csrf
            @if(isset($product)) @method('PUT') @endif

            <!-- Product Name -->
            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Product Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $product->name ?? '') }}"
                       class="w-full border px-4 py-2 rounded" required>
            </div>

            <!-- Brand -->
            <div class="mb-4">
                <label for="brand" class="block font-semibold mb-1">Brand</label>
                <input type="text" name="brand" id="brand"
                       value="{{ old('brand', $product->brand ?? '') }}"
                       class="w-full border px-4 py-2 rounded" required>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category" class="block font-semibold mb-1">Category</label>
                <select name="category" id="category" required
                        class="w-full border px-4 py-2 rounded bg-white text-gray-800">
                    <option value="">Select Category</option>
                    @foreach([
                        'Tinted Moisturizer', 'Foundation', 'BB & CC Cream', 'Cushion', 'Concealer', 'Powder', 'Bronzer', 'Primer',
                        'Highlighter', 'Contour', 'Blush', 'Eyeliner', 'Mascara', 'Eyeshadow', 'Eyebrows', 'Lipstick',
                        'Lip Liner', 'Lipstain & Tint', 'Lip Balm', 'Lip Gloss', 'Cleanser', 'Moisturizer', 'Toner', 'Sunscreen'
                    ] as $option)
                        <option value="{{ $option }}"
                            {{ old('category', $product->category ?? '') === $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>


            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block font-semibold mb-1">Price (Rp)</label>
                <input type="number" name="price" id="price"
                       value="{{ old('price', $product->price ?? '') }}"
                       class="w-full border px-4 py-2 rounded" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block font-semibold mb-1">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full border px-4 py-2 rounded">{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <!-- Ingredients -->
            <div class="mb-4">
                <label for="ingredients" class="block font-semibold mb-1">Ingredients</label>
                <textarea name="ingredients" id="ingredients" rows="3"
                          class="w-full border px-4 py-2 rounded">{{ old('ingredients', $product->ingredients ?? '') }}</textarea>
            </div>

            <!-- stock  -->
            <div class="mb-4">
                <label for="stock" class="block font-semibold mb-1">Stock</label>
                <input type="number" name="stock" id="stock"
                       value="{{ old('stock', $product->stock ?? '') }}"
                       class="w-full border px-4 py-2 rounded" required>
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label class="block font-semibold mb-1">Product Image</label>
                <input type="file" name="image" class="w-full border px-4 py-2 rounded">
                @if(isset($product) && $product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                         class="h-20 mt-2 rounded">
                @endif
            </div>

            <!-- Submit -->
            <div class="text-right">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    {{ isset($product) ? 'Update Product' : 'Add Product' }}
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
