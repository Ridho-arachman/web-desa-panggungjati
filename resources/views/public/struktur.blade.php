@extends('layouts.public')
@section('title', 'Struktur Organisasi')
@section('content')

@php
    $kelurahan = \App\Models\Setting::where('key', 'kelurahan_name')->value('value') ?? 'Kelurahan';
    $strukturDesc = \App\Models\Setting::where('key', 'struktur_description')->value('value') 
                     ?? 'Susunan perangkat ' . $kelurahan . ' yang siap melayani masyarakat.';
@endphp

{{-- Hero --}}
<div class="relative bg-linear-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-16 pb-28 overflow-hidden">
    <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-10"></div>
    <div class="absolute inset-0 bg-linear-to-t from-black/20 to-transparent"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-2">
            <svg class="h-10 w-10 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
                Struktur <span class="text-yellow-300">{{ $kelurahan }}</span>
            </h1>
        </div>
        <p class="mt-2 text-blue-100 text-lg max-w-2xl">{{ $strukturDesc }}</p>
    </div>
    
    {{-- Wave divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 150" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60L60 65C120 70 240 80 360 75C480 70 600 50 720 45C840 40 960 50 1080 65C1200 80 1320 100 1380 110L1440 120V150H1380C1320 150 1200 150 1080 150C960 150 840 150 720 150C600 150 480 150 360 150C240 150 120 150 60 150H0V60Z" fill="#f9fafb"/>
        </svg>
    </div>
</div>

{{-- Daftar Anggota --}}
<div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8 bg-gray-50">
    @if($members->isEmpty())
        {{-- Empty state --}}
        <div class="text-center py-20">
            <div class="bg-white inline-block p-6 rounded-full shadow-sm mb-6">
                <svg class="h-20 w-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-semibold text-gray-500 mb-2">Data belum tersedia</h3>
            <p class="text-gray-400 max-w-md mx-auto">Struktur organisasi {{ $kelurahan }} akan ditampilkan di sini setelah ditambahkan oleh admin.</p>
        </div>
    @else
        @foreach($members->whereNull('parent_id')->sortBy('order') as $head)
            {{-- Kepala / Lurah --}}
            <div class="flex flex-col items-center mb-16">
                <div class="relative group">
                    <div class="w-40 h-40 rounded-full border-4 border-blue-600 shadow-lg overflow-hidden mx-auto bg-white">
                        @if($head->photo)
                            <img src="{{ asset('storage/' . $head->photo) }}" alt="{{ $head->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-blue-100 flex items-center justify-center text-blue-700 text-5xl font-bold">
                                {{ strtoupper(substr($head->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>                    
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mt-4">{{ $head->name }}</h3>
                <p class="text-blue-600 font-semibold text-lg">{{ $head->position }}</p>
                
                {{-- Garis penghubung (opsional, bisa ditambahkan SVG) --}}
                @if($head->children->count() > 0)
                    <svg class="h-8 w-8 text-blue-300 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                @endif
            </div>

            {{-- Bawahan --}}
            @if($head->children->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-16">
                    @foreach($head->children->sortBy('order') as $child)
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 p-6 text-center transform hover:-translate-y-1">
                            <div class="w-24 h-24 rounded-full border-4 border-blue-100 overflow-hidden mx-auto">
                                @if($child->photo)
                                    <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-blue-100 flex items-center justify-center text-blue-700 text-3xl font-bold">
                                        {{ strtoupper(substr($child->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <h4 class="font-bold text-gray-900 mt-3">{{ $child->name }}</h4>
                            <p class="text-blue-600 text-sm">{{ $child->position }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    @endif
</div>

@endsection