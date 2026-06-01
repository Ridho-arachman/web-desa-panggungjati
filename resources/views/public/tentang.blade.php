@extends('layouts.public')
@section('title', 'Tentang')
@section('content')

@php
    $kelurahan = \App\Models\Setting::where('key', 'kelurahan_name')->value('value') ?? 'Kelurahan';
    $visi = \App\Models\Setting::where('key', 'visi')->value('value') ?? '';
    $misi = \App\Models\Setting::where('key', 'misi')->value('value') ?? '';
    $sejarah = \App\Models\Setting::where('key', 'sejarah')->value('value') ?? '';
    $profil = \App\Models\Setting::where('key', 'profil')->value('value') ?? '';
    $gmaps = \App\Models\Setting::where('key', 'gmaps_embed')->value('value') ?? '';
    $alamat = \App\Models\Setting::where('key', 'alamat')->value('value') ?? '';

    $lurah = \App\Models\OrganizationMember::where('position', 'like', '%lurah%')
        ->orWhere('position', 'like', '%kepala desa%')
        ->first();
@endphp

{{-- Hero --}}
<div class="relative bg-linear-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-16 pb-28 overflow-hidden">
    <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-10"></div>
    <div class="absolute inset-0 bg-linear-to-t from-black/20 to-transparent"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-2">
            <svg class="h-10 w-10 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
                Tentang <span class="text-yellow-300">{{ $kelurahan }}</span>
            </h1>
        </div>
        <p class="mt-2 text-blue-100 text-lg max-w-2xl ml-14">
            Profil lengkap, visi & misi, sejarah, dan informasi {{ $kelurahan }}.
        </p>
    </div>
    
    {{-- Wave divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 150" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60L60 65C120 70 240 80 360 75C480 70 600 50 720 45C840 40 960 50 1080 65C1200 80 1320 100 1380 110L1440 120V150H1380C1320 150 1200 150 1080 150C960 150 840 150 720 150C600 150 480 150 360 150C240 150 120 150 60 150H0V60Z" fill="#f9fafb"/>
        </svg>
    </div>
</div>

{{-- Konten Utama --}}
<div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8 bg-gray-50">

    {{-- Google Maps --}}
    @if($gmaps)
    <div class="mb-16">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Lokasi Kantor {{ $kelurahan }}</h2>
        <div class="bg-white rounded-2xl shadow-md overflow-hidden p-4">
            <div class="relative w-full aspect-video rounded-xl overflow-hidden [&>iframe]:absolute [&>iframe]:inset-0 [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                {!! $gmaps !!}
            </div>
        </div>
    </div>
    @endif

    {{-- Sejarah --}}
    @if($sejarah)
    <div class="mb-16">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Sejarah {{ $kelurahan }}</h2>
        <div class="bg-white rounded-2xl shadow-md p-8 md:p-10 prose max-w-none text-gray-700">
            {!! $sejarah !!}
        </div>
    </div>
    @endif

    {{-- Visi & Misi --}}
    @if($visi || $misi)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-16">
        @if($visi)
        <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Visi</h3>
            </div>
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($visi)) !!}
            </div>
        </div>
        @endif

        @if($misi)
        <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="h-6 w-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Misi</h3>
            </div>
            <div class="prose max-w-none text-gray-700">
                {!! $misi !!}
            </div>
        </div>
        @endif
    </div>
    @endif

    {{-- Profil Lengkap --}}
    @if($profil)
    <div class="mb-16">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Profil {{ $kelurahan }}</h2>
        <div class="bg-white rounded-2xl shadow-md p-8 md:p-10 prose max-w-none text-gray-700">
            {!! $profil !!}
        </div>
    </div>
    @endif

    {{-- Foto Lurah + Alamat --}}
    @if($lurah || $alamat)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        @if($lurah)
        <div class="bg-white rounded-2xl shadow-md p-8 text-center hover:shadow-xl transition-all duration-300">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Kepala {{ $kelurahan }}</h3>
            <div class="w-40 h-40 rounded-full border-4 border-blue-600 shadow-lg overflow-hidden mx-auto mb-4">
                @if($lurah->photo)
                    <img src="{{ asset('storage/' . $lurah->photo) }}" alt="{{ $lurah->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-blue-100 flex items-center justify-center text-blue-700 text-5xl font-bold">
                        {{ strtoupper(substr($lurah->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <h4 class="text-2xl font-bold text-gray-900">{{ $lurah->name }}</h4>
            <p class="text-blue-600 font-semibold text-lg">{{ $lurah->position }}</p>
        </div>
        @endif

        @if($alamat)
        <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Alamat</h3>
            </div>
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($alamat)) !!}
            </div>
        </div>
        @endif
    </div>
    @endif
</div>

@endsection