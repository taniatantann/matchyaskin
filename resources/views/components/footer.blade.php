<footer class="bg-gray-50 border-t text-sm text-gray-700">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 sm:grid-cols-4 gap-8">
        <!-- Brand Section -->
        <div>
            <div class="flex items-center space-x-2 mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-18" />
            </div>
            <p class="text-sm text-gray-700 leading-relaxed">
                match ya skin is here to help<br />
                you find the perfect cosmetics<br />
                for your personal skin type.
            </p>
        </div>

        <!-- Shop Links -->
        <div>
            <h4 class="text-gray-900 font-semibold mb-3 uppercase">Shop</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('user.makeup') }}" class="hover:underline">Find your skin type here!</a></li>
                <li><a href="{{ route('products.show') }}" class="hover:underline">Makeup</a></li>
                <li><a href="{{ route('products.show') }}" class="hover:underline">Skincare</a></li>
            </ul>
        </div>

        <!-- About Links -->
        <div>
            <h4 class="text-gray-900 font-semibold mb-3 uppercase">About Us</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('about') }}" class="hover:underline">About Match ya Skin</a></li>
            </ul>
        </div>

        <!-- Contact Icons -->
        <div>
            <h4 class="text-gray-900 font-semibold mb-3 uppercase">Contact Us</h4>
            <div class="flex items-center space-x-4 mt-2">
                <a href="https://wa.me/"><img src="https://img.icons8.com/ios-filled/24/000000/whatsapp.png" /></a>
                <a href="https://www.instagram.com/"><img src="https://img.icons8.com/ios-filled/24/000000/instagram-new.png" /></a>
                <a href="https://gmail.com/"><img src="https://img.icons8.com/ios-filled/24/000000/new-post.png" /></a>
            </div>
        </div>
    </div>
</footer>
