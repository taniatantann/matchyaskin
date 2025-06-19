<!-- resources/views/user/dashboard.blade.php -->

<h1 class="text-2xl font-bold mb-4">Selamat datang di Matchyaskin (Customer)</h1>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm">
        Logout
    </button>
</form>
