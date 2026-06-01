@extends('layouts.public')
@section('title', 'Masukan Warga')
@section('content')

@php
    $kelurahan = \App\Models\Setting::where('key', 'kelurahan_name')->value('value') ?? 'Kelurahan';
    $hasSuccess = session()->has('success');
    $hasError = session()->has('error');
    $notifMessage = $hasSuccess ? session('success') : ($hasError ? session('error') : '');
    $notifType = $hasSuccess ? 'success' : ($hasError ? 'error' : '');
@endphp

{{-- Hero --}}
<div class="relative bg-linear-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-16 pb-28 overflow-hidden">
    <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-10"></div>
    <div class="absolute inset-0 bg-linear-to-t from-black/20 to-transparent"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-2">
            <svg class="h-10 w-10 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
                Masukan Warga <span class="text-yellow-300">{{ $kelurahan }}</span>
            </h1>
        </div>
        <p class="mt-2 text-blue-100 text-lg max-w-2xl ml-14">
            Suara Anda penting untuk kemajuan {{ $kelurahan }}. Sampaikan aspirasi, kritik, dan saran Anda di sini.
        </p>
    </div>
    
    {{-- Wave divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 150" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60L60 65C120 70 240 80 360 75C480 70 600 50 720 45C840 40 960 50 1080 65C1200 80 1320 100 1380 110L1440 120V150H1380C1320 150 1200 150 1080 150C960 150 840 150 720 150C600 150 480 150 360 150C240 150 120 150 60 150H0V60Z" fill="#f9fafb"/>
        </svg>
    </div>
</div>

{{-- Form Masukan --}}
<div class="max-w-3xl mx-auto px-4 py-16 sm:px-6 lg:px-8 bg-gray-50 relative">

    {{-- Notifikasi Toast --}}
    @if($notifType)
    <div id="notification-toast" class="fixed top-6 right-6 z-9999 flex items-start gap-3 p-4 rounded-xl shadow-lg border backdrop-blur-sm toast-enter
        {{ $notifType === 'success' ? 'bg-green-50 border-green-300 text-green-800' : 'bg-red-50 border-red-300 text-red-800' }}">
        <div class="shrink-0 mt-0.5">
            @if($notifType === 'success')
            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            @else
            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            @endif
        </div>
        <div class="flex-1">
            <p class="font-semibold text-sm">{{ $notifType === 'success' ? 'Berhasil!' : 'Gagal!' }}</p>
            <p class="text-sm opacity-90">{{ $notifMessage }}</p>
        </div>
        <button onclick="dismissToast()" class="text-gray-400 hover:text-gray-600 transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    @endif

    <form action="{{ route('masukan.store') }}" method="POST" class="bg-white rounded-2xl shadow-md p-8 md:p-10">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Lengkap --}}
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    required 
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap Anda"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400 @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}"
                    placeholder="contoh@email.com"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400 @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- No. Telepon --}}
            <div class="md:col-span-2">
                <label for="phone" class="block text-gray-700 font-medium mb-2">No. Telepon</label>
                <input 
                    type="text" 
                    name="phone" 
                    id="phone" 
                    value="{{ old('phone') }}"
                    placeholder="0812-3456-7890"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400 @error('phone') border-red-500 @enderror"
                >
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pesan / Masukan --}}
            <div class="md:col-span-2">
                <label for="message" class="block text-gray-700 font-medium mb-2">
                    Pesan / Masukan <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="message" 
                    id="message" 
                    rows="6" 
                    required 
                    placeholder="Tulis aspirasi, kritik, atau saran Anda untuk {{ $kelurahan }}..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400 resize-none @error('message') border-red-500 @enderror"
                >{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Tombol Kirim --}}
        <div class="mt-8">
            <button type="submit" 
                class="w-full md:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 inline-flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Kirim Masukan
            </button>
        </div>
    </form>
</div>

{{-- Styles & Scripts untuk Toast Animasi --}}
@if($notifType)
<style>
    .toast-enter {
        animation: slideInRight 0.5s ease-out forwards;
    }
    .toast-exit {
        animation: slideOutRight 0.4s ease-in forwards;
    }
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(120%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(120%);
        }
    }
</style>

<script>
function dismissToast() {
    var toast = document.getElementById('notification-toast');
    if (toast) {
        toast.classList.remove('toast-enter');
        toast.classList.add('toast-exit');
        setTimeout(function() {
            if (toast) toast.remove();
        }, 400); // sesuai durasi animasi keluar
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide setelah 5 detik
    setTimeout(dismissToast, 5000);
});
</script>
@endif

@endsection