@extends('layouts.app')

@section('content')
<div class="container max-w-2xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Personal Skin Test</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.test.submit') }}" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="result_skin_type" class="block font-medium text-gray-700 mb-2">
                Masukkan hasil analisa Skin Type Anda (Contoh: DRPT, OSNT, dsb)
            </label>
            <input type="text" name="result_skin_type" id="result_skin_type" class="w-full border px-4 py-2 rounded @error('result_skin_type') border-red-500 @enderror" value="{{ old('result_skin_type', $skinTest->result_skin_type ?? '') }}" required>
            @error('result_skin_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn-primary">Simpan & Lihat Rekomendasi</button>
    </form>
</div>
@endsection
