@extends('layouts.public')
@section('title', 'Layanan Surat')
@section('content')

@php
    $kelurahan = \App\Models\Setting::where('key', 'kelurahan_name')->value('value') ?? 'Kelurahan';
    $suratDesc = \App\Models\Setting::where('key', 'surat_description')->value('value') 
                  ?? 'Pilih jenis surat yang Anda butuhkan dan isi formulir Google Form yang telah disediakan.';
    $search = request('search', '');
@endphp

{{-- Hero --}}
<div class="relative bg-linear-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-16 pb-28 overflow-hidden">
    <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-10"></div>
    <div class="absolute inset-0 bg-linear-to-t from-black/20 to-transparent"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-2">
            <svg class="h-10 w-10 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
                Layanan Surat <span class="text-yellow-300">{{ $kelurahan }}</span>
            </h1>
        </div>
        <p class="mt-2 text-blue-100 text-lg max-w-2xl">{{ $suratDesc }}</p>
    </div>
    
    {{-- Wave divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 150" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60L60 65C120 70 240 80 360 75C480 70 600 50 720 45C840 40 960 50 1080 65C1200 80 1320 100 1380 110L1440 120V150H1380C1320 150 1200 150 1080 150C960 150 840 150 720 150C600 150 480 150 360 150C240 150 120 150 60 150H0V60Z" fill="#f9fafb"/>
        </svg>
    </div>
</div>

{{-- Daftar Surat --}}
<div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8 bg-gray-50">
    @if($letterTypes->count() || $search)
        {{-- Form Pencarian --}}
        <div class="mb-8 max-w-md mx-auto">
            <form method="GET" action="{{ url('/surat') }}" class="relative flex items-center">
                <div class="relative flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ old('search', $search) }}"
                        placeholder="Cari jenis surat..." 
                        class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-gray-700"
                    >
                    {{-- Ikon search di kiri --}}
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    {{-- Tombol X di kanan dalam input --}}
                    @if($search)
                        <a href="{{ url('/surat') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 p-1">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    @endif
                </div>
                <button type="submit" class="ml-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-3 rounded-xl transition shadow-md">
                    Cari
                </button>
            </form>
        </div>

        @if($letterTypes->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($letterTypes as $type)
                    <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2 flex flex-col">
                        {{-- Header dengan ikon --}}
                        <div class="bg-linear-to-br from-blue-500 to-blue-600 p-6 text-white relative overflow-hidden">
                            <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
                            <div class="absolute -bottom-6 -left-6 w-20 h-20 bg-white/10 rounded-full"></div>
                            <svg class="h-10 w-10 mb-3 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="text-xl font-bold relative z-10">{{ $type->name }}</h3>
                        </div>

                        {{-- Konten --}}
                        <div class="p-6 flex flex-col grow">
                            @if($type->description)
                                <div class="prose prose-sm max-w-none text-gray-600 mb-6 leading-relaxed line-clamp-3">
                                    {!! $type->description !!}
                                </div>
                            @else
                                <p class="text-gray-400 italic mb-6">Tidak ada deskripsi tambahan.</p>
                            @endif
                            <a href="{{ $type->gform_link }}" target="_blank" 
                               class="mt-auto w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-3 rounded-xl transition-all transform hover:scale-105 shadow-md hover:shadow-lg">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Ajukan via Google Form
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12 pagination-wrapper">
                {{ $letterTypes->appends(['search' => $search])->links() }}
            </div>
        @else
            <div class="text-center py-10">
                <p class="text-gray-500">Tidak ada surat ditemukan untuk "<strong>{{ $search }}</strong>".</p>
                <a href="{{ url('/surat') }}" class="text-blue-600 hover:underline mt-2 inline-block">Tampilkan semua surat</a>
            </div>
        @endif
    @else
        {{-- Empty state --}}
        <div class="text-center py-20">
            <div class="bg-white inline-block p-6 rounded-full shadow-sm mb-6">
                <svg class="h-20 w-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-semibold text-gray-500 mb-2">Belum ada layanan surat</h3>
            <p class="text-gray-400 max-w-md mx-auto">Jenis surat yang tersedia akan ditampilkan di sini setelah ditambahkan oleh admin {{ $kelurahan }}.</p>
        </div>
    @endif
</div>

@endsection