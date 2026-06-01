@extends('layouts.public')
@section('title', 'Berita')
@section('content')

@php
    $kelurahan = \App\Models\Setting::where('key', 'kelurahan_name')->value('value') ?? 'Desa';
    $beritaDesc = \App\Models\Setting::where('key', 'berita_description')->value('value') 
                  ?? 'Informasi terkini seputar kegiatan dan pembangunan ' . $kelurahan . '.';
@endphp

{{-- Hero Header --}}
<div class="relative bg-linear-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-16 pb-28 overflow-hidden">
    {{-- Background pattern --}}
    <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-10"></div>
    <div class="absolute inset-0 bg-linear-to-t from-black/20 to-transparent"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-2">
            <svg class="h-10 w-10 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
                Berita <span class="text-yellow-300">{{ $kelurahan }}</span>
            </h1>
        </div>
        <p class="mt-2 text-blue-100 text-lg max-w-2xl">{{ $beritaDesc }}</p>
    </div>
    
    {{-- Wave divider (lebih landai) --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 150" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60L60 65C120 70 240 80 360 75C480 70 600 50 720 45C840 40 960 50 1080 65C1200 80 1320 100 1380 110L1440 120V150H1380C1320 150 1200 150 1080 150C960 150 840 150 720 150C600 150 480 150 360 150C240 150 120 150 60 150H0V60Z" fill="#f9fafb"/>
        </svg>
    </div>
</div>

{{-- Daftar Berita --}}
<div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8 bg-gray-50">
    @if($news->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($news as $item)
                <a href="{{ url('/berita/' . $item->slug) }}" class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-1">
                    {{-- Gambar --}}
                    <div class="relative h-52 overflow-hidden">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-full bg-linear-to-br from-blue-100 to-blue-200 flex items-center justify-center text-blue-400">
                                <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                        @endif
                        {{-- Overlay gradasi saat hover --}}
                        <div class="absolute inset-0 bg-linear-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        {{-- Badge jika baru (dalam 7 hari) --}}
                        @if($item->published_at?->diffInDays(now()) <= 3)
                            <div class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full shadow">
                                BARU
                            </div>
                        @endif
                    </div>

                    {{-- Konten teks --}}
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-900 mb-2 group-hover:text-blue-700 transition line-clamp-2">
                            {{ $item->title }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($item->content), 120) }}
                        </p>
                        
                        <div class="flex items-center justify-between text-xs text-gray-500 mt-4">
                            <div class="flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $item->published_at?->translatedFormat('d M Y') ?? 'Belum terbit' }}</span>
                            </div>
                            <span class="text-blue-600 font-medium flex items-center gap-1 group-hover:gap-2 transition-all">
                                Baca
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination cantik --}}
        <div class="mt-12 flex justify-center">
            <div class="inline-flex items-center bg-white rounded-xl shadow-sm px-4 py-2 text-sm">
                {{ $news->links() }}
            </div>
        </div>
    @else
        {{-- Empty state --}}
        <div class="text-center py-20">
            <svg class="h-20 w-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <h3 class="text-2xl font-semibold text-gray-500 mb-2">Belum ada berita</h3>
            <p class="text-gray-400">Berita terbaru dari {{ $kelurahan }} akan muncul di sini.</p>
        </div>
    @endif
</div>
@endsection