@extends('layouts.public')
@section('title', $news->title)
@section('content')

@php
    $kelurahan = \App\Models\Setting::where('key', 'kelurahan_name')->value('value') ?? 'Desa';
@endphp

{{-- Hero Parallax --}}
<div class="relative h-[70vh] min-h-125 bg-gray-900 overflow-hidden">
    {{-- Gambar Background --}}
    @if($news->image)
        <div class="absolute inset-0 bg-fixed bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $news->image) }}');"></div>
    @else
        <div class="absolute inset-0 bg-linear-to-br from-blue-700 via-blue-800 to-indigo-900"></div>
    @endif
    
    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-linear-to-t from-gray-900 via-gray-900/60 to-gray-900/30"></div>
    
    {{-- Konten Hero --}}
    <div class="relative z-10 h-full flex flex-col justify-end max-w-5xl mx-auto px-6 pb-16 sm:px-8 lg:px-10">
        {{-- Badge Kategori (bisa pakai status atau custom) --}}
        <div class="mb-4">
            <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-1.5 rounded-full border border-white/20">
                📰 Berita {{ $kelurahan }}
            </span>
        </div>
        
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight max-w-4xl">
            {{ $news->title }}
        </h1>
        
        <div class="flex flex-wrap items-center gap-6 text-sm text-gray-200">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="font-medium">{{ $news->author->name ?? 'Admin ' . $kelurahan }}</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span>{{ $news->published_at?->translatedFormat('d F Y') }}</span>
            </div>
        </div>
    </div>
    
    {{-- Scroll Indicator --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 animate-bounce">
        <svg class="h-6 w-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</div>

{{-- Breadcrumb --}}
<div class="bg-white border-b border-gray-100 sticky top-0 z-30 shadow-sm">
    <div class="max-w-5xl mx-auto px-6 sm:px-8 lg:px-10 py-3">
        <nav class="flex items-center text-sm text-gray-500 space-x-2">
            <a href="{{ url('/') }}" class="hover:text-blue-600 transition">
                <svg class="h-4 w-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
            <span>/</span>
            <a href="{{ url('/berita') }}" class="hover:text-blue-600 transition">Berita</a>
            <span>/</span>
            <span class="text-gray-400 truncate max-w-xs">{{ $news->title }}</span>
        </nav>
    </div>
</div>

{{-- Konten Utama --}}
<div class="bg-white">
    <div class="max-w-5xl mx-auto px-6 sm:px-8 lg:px-10 py-12">
        <div class="flex flex-col lg:flex-row gap-10">
            {{-- Artikel --}}
            <article class="flex-1 prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-a:text-blue-600 prose-img:rounded-xl">
                {!! $news->content !!}
                
                {{-- Galeri Gambar Tambahan --}}
                @if($news->images->count())
                    <div class="mt-12 not-prose">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Galeri
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($news->images as $img)
                                <a href="{{ asset('storage/' . $img->path) }}" data-fancybox="gallery" class="group block overflow-hidden rounded-xl bg-gray-100">
                                    <img src="{{ asset('storage/' . $img->path) }}" alt="Foto {{ $news->title }}" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </article>
        </div>
        
        {{-- Tombol Kembali --}}
        <div class="mt-12 pt-8 border-t border-gray-100 flex justify-center">
            <a href="{{ url('/berita') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-full transition">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Berita
            </a>
        </div>
    </div>
</div>

{{-- Berita Terkait --}}
@if($relatedNews->count())
<div class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900">Berita Lainnya</h2>
            <p class="text-gray-600 mt-3 text-lg">Jangan lewatkan berita menarik dari {{ $kelurahan }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedNews as $item)
            <a href="{{ url('/berita/' . $item->slug) }}" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                <div class="h-52 overflow-hidden">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-linear-to-br from-blue-100 to-blue-200 flex items-center justify-center text-blue-400">
                            <svg class="h-14 w-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-6 flex flex-col grow">
                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-blue-600 transition line-clamp-2 mb-3">{{ $item->title }}</h3>
                    <div class="flex items-center text-sm text-gray-500 mt-auto">
                        <svg class="h-4 w-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $item->published_at?->translatedFormat('d M Y') }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection