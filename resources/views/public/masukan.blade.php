@extends('layouts.public')
@section('title', 'Masukan Warga')
@section('content')
<div class="bg-blue-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold">Masukan Warga</h1>
        <p class="mt-2 text-blue-100">Suara Anda penting untuk kemajuan desa. Sampaikan aspirasi, kritik, dan saran.</p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('masukan.store') }}" method="POST" class="bg-white rounded-xl shadow p-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">No. Telepon</label>
                <input type="text" name="phone" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-1">Pesan / Masukan</label>
                <textarea name="message" rows="5" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
        </div>
        <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
            Kirim Masukan
        </button>
    </form>
</div>
@endsection