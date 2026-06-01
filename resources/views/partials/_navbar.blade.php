{{-- Navbar dengan Blur & Logo dari Settings --}}
<nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-white/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            {{-- Logo & Nama Kelurahan --}}
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center space-x-3">
                    @php
                        $logo = \App\Models\Setting::where('key', 'logo')->value('value');
                        $kelurahanName = \App\Models\Setting::where('key', 'kelurahan_name')->value('value') ?? 'Kelurahan Panggungjati';
                    @endphp
                    <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $kelurahanName }}" class="h-10 w-auto rounded-lg">
                    <span class="text-2xl font-bold text-blue-700">
                        {{ $kelurahanName }}
                    </span>
                </a>
            </div>

            {{-- Menu Desktop --}}
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-700 font-medium transition-colors {{ request()->is('/') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Beranda</a>
                <a href="{{ url('/surat') }}" class="text-gray-700 hover:text-blue-700 font-medium transition-colors {{ request()->is('surat*') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Layanan Surat</a>
                <a href="{{ url('/berita') }}" class="text-gray-700 hover:text-blue-700 font-medium transition-colors {{ request()->is('berita*') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Berita</a>
                <a href="{{ url('/struktur') }}" class="text-gray-700 hover:text-blue-700 font-medium transition-colors {{ request()->is('struktur*') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Struktur Organisasi</a>
                <a href="{{ url('/masukan') }}" class="text-gray-700 hover:text-blue-700 font-medium transition-colors {{ request()->is('masukan*') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">Masukan</a>
            </div>

            {{-- Tombol Hamburger Mobile --}}
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-700 focus:outline-none p-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menu Mobile --}}
        <div id="mobile-menu" class="hidden md:hidden pb-4 pt-2 space-y-1">
            <a href="{{ url('/') }}" class="block py-2 px-4 text-gray-700 rounded-lg hover:bg-blue-50 transition {{ request()->is('/') ? 'text-blue-700 font-semibold bg-blue-50' : '' }}">Beranda</a>
            <a href="{{ url('/surat') }}" class="block py-2 px-4 text-gray-700 rounded-lg hover:bg-blue-50 transition {{ request()->is('surat*') ? 'text-blue-700 font-semibold bg-blue-50' : '' }}">Layanan Surat</a>
            <a href="{{ url('/berita') }}" class="block py-2 px-4 text-gray-700 rounded-lg hover:bg-blue-50 transition {{ request()->is('berita*') ? 'text-blue-700 font-semibold bg-blue-50' : '' }}">Berita</a>
            <a href="{{ url('/struktur') }}" class="block py-2 px-4 text-gray-700 rounded-lg hover:bg-blue-50 transition {{ request()->is('struktur*') ? 'text-blue-700 font-semibold bg-blue-50' : '' }}">Struktur Organisasi</a>
            <a href="{{ url('/masukan') }}" class="block py-2 px-4 text-gray-700 rounded-lg hover:bg-blue-50 transition {{ request()->is('masukan*') ? 'text-blue-700 font-semibold bg-blue-50' : '' }}">Masukan</a>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>