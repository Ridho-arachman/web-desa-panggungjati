@extends('layouts.public')
@section('title', 'Beranda')
@section('content')

    {{-- Hero dengan Foto Lurah dari Database --}}
    <div class="relative bg-linear-to-br from-blue-700 via-blue-800 to-indigo-900 text-white overflow-hidden">
        <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-10"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-10">
                {{-- Foto Lurah --}}
                <div class="shrink-0">
                    <div class="w-48 h-48 sm:w-56 sm:h-56 rounded-full border-4 border-white/30 shadow-2xl overflow-hidden mx-auto">
                        @if($lurah && $lurah->photo)
                            <img src="{{ asset('storage/' . $lurah->photo) }}" alt="Foto {{ $lurah->name }}" class="w-full h-full object-cover object-top">
                        @else
                            <div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-500 text-4xl font-bold">
                                {{ $lurah ? strtoupper(substr($lurah->name, 0, 1)) : 'L' }}
                            </div>
                        @endif
                    </div>
                </div>
                {{-- Teks Selamat Datang --}}
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight mb-2">
                        Selamat Datang di
                    </h1>
                    <h2 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-yellow-300 mb-4">
                        Kelurahan Panggungjati
                    </h2>
                    <p class="text-lg text-blue-100 max-w-2xl mb-6">
                        {{ \App\Models\Setting::where('key', 'visi')->value('value') ?? 'Kami siap melayani dengan sepenuh hati. Bersama kita wujudkan Kelurahan yang Bersatu Maju Mandiri Sejahtera Religius dan Terdepan.' }}
                    </p>
                    <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                        <a href="{{ url('/surat') }}" class="bg-yellow-400 text-blue-900 font-bold px-6 py-3 rounded-full shadow-lg hover:bg-yellow-300 transition transform hover:scale-105">
                            Ajukan Surat
                        </a>
                        <a href="{{ url('/struktur') }}" class="bg-white/20 backdrop-blur text-white font-semibold px-6 py-3 rounded-full hover:bg-white/30 transition">
                            Struktur Organisasi
                        </a>
                    </div>
                </div>
            </div>
            {{-- Nama dan Jabatan Lurah --}}
            <div class="mt-8 text-center lg:text-left lg:pl-60">
                <p class="text-lg font-medium text-blue-200">
                    {{ $lurah ? $lurah->name : (\App\Models\Setting::where('key', 'kepala_desa')->value('value') ?? 'Nama Lurah') }}
                    <span class="text-sm block">{{ $lurah ? $lurah->position : 'Kepala Kelurahan Panggungjati' }}</span>
                </p>
            </div>
        </div>
        {{-- Wave Divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 60L60 55C120 50 240 40 360 45C480 50 600 70 720 75C840 80 960 70 1080 55C1200 40 1320 20 1380 10L1440 0V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V60Z" fill="#f9fafb"/>
            </svg>
        </div>
    </div>

    {{-- Statistik Singkat --}}
    <div class="bg-gray-50 -mt-1 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="bg-white rounded-2xl shadow p-6 transform hover:-translate-y-1 transition">
                    <div class="text-3xl font-bold text-blue-700">{{ \App\Models\LetterType::where('is_active', true)->count() }}</div>
                    <div class="text-gray-600">Jenis Surat</div>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 transform hover:-translate-y-1 transition">
                    <div class="text-3xl font-bold text-blue-700">
                        {{ \App\Models\News::where('status', 'published')->where('published_at', '<=', now())->count() }}
                    </div>
                    <div class="text-gray-600">Berita</div>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 transform hover:-translate-y-1 transition">
                    <div class="text-3xl font-bold text-blue-700">{{ \App\Models\CitizenInput::count() }}</div>
                    <div class="text-gray-600">Masukan</div>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 transform hover:-translate-y-1 transition">
                    <div class="text-3xl font-bold text-blue-700">{{ \App\Models\OrganizationMember::count() }}</div>
                    <div class="text-gray-600">Pengurus</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Layanan Unggulan --}}
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Layanan Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Kami hadir untuk memudahkan segala keperluan administrasi dan informasi kelurahan.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Surat Online -->
                <div class="group bg-gray-50 rounded-3xl p-8 hover:bg-blue-50 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-blue-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Surat Online</h3>
                    <p class="text-gray-600 mb-4">Ajukan surat keterangan, pengantar, dan lainnya melalui Google Form yang telah disediakan.</p>
                    <a href="{{ url('/surat') }}" class="text-blue-700 font-medium hover:underline inline-flex items-center">
                        Lihat Jenis Surat
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
                <!-- Berita -->
                <div class="group bg-gray-50 rounded-3xl p-8 hover:bg-indigo-50 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-indigo-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Berita Kelurahan</h3>
                    <p class="text-gray-600 mb-4">Informasi terkini seputar kegiatan, pembangunan, dan pengumuman kelurahan.</p>
                    <a href="{{ url('/berita') }}" class="text-indigo-700 font-medium hover:underline inline-flex items-center">
                        Baca Berita
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
                <!-- Masukan -->
                <div class="group bg-gray-50 rounded-3xl p-8 hover:bg-amber-50 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-amber-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Masukan Warga</h3>
                    <p class="text-gray-600 mb-4">Sampaikan aspirasi, kritik, dan saran Anda untuk kemajuan kelurahan.</p>
                    <a href="{{ url('/masukan') }}" class="text-amber-700 font-medium hover:underline inline-flex items-center">
                        Beri Masukan
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Berita Terbaru --}}
    @if($latestNews->count() > 0)
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Berita Terbaru</h2>
                    <p class="text-gray-600 mt-1">Kabar terkini dari Kelurahan Panggungjati</p>
                </div>
                <a href="{{ url('/berita') }}" class="hidden sm:inline-flex items-center text-blue-700 font-semibold hover:underline">
                    Lihat Semua
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestNews as $news)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col">
                    @if($news->image)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $news->image) }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                    </div>
                    @endif
                    <div class="p-6 flex flex-col grow">
                        <div class="mb-3">
                            <span class="text-xs text-blue-700 bg-blue-100 px-2 py-1 rounded-full">{{ $news->published_at?->format('d M Y') }}</span>
                        </div>
                        <h3 class="font-bold text-lg mb-2 leading-tight">{{ $news->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 grow">{{ Str::limit(strip_tags($news->content), 120) }}</p>
                        <a href="{{ url('/berita/' . $news->slug) }}" class="text-blue-700 font-medium hover:underline inline-flex items-center mt-auto">
                            Baca Lengkap
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Kutipan --}}
    <div class="bg-linear-to-r from-blue-700 to-indigo-700 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <svg class="h-10 w-10 mx-auto mb-4 opacity-75" fill="currentColor" viewBox="0 0 24 24"><path d="M10 11h-4a1 1 0 01-1-1v-3a1 1 0 011-1h3a1 1 0 011 1v3c0 2.21-1.79 4-4 4v-2c1.1 0 2-.9 2-2v-1zm12 0h-4a1 1 0 01-1-1v-3a1 1 0 011-1h3a1 1 0 011 1v3c0 2.21-1.79 4-4 4v-2c1.1 0 2-.9 2-2v-1z"/></svg>
            <p class="text-xl font-medium italic mb-4">
                "{{ \App\Models\Setting::where('key', 'kutipan')->value('value') ?? 'Pelayanan yang cepat, transparan, dan ramah adalah prioritas kami untuk warga Panggungjati.' }}"
            </p>
            <p class="font-semibold">{{ $lurah ? $lurah->name : (\App\Models\Setting::where('key', 'kepala_desa')->value('value') ?? 'Nama Lurah') }} - Kepala Kelurahan Panggungjati</p>
        </div>
    </div>

@endsection