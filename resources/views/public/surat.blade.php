@extends('layouts.public')
@section('title', 'Layanan Surat')
@section('content')
<div class="bg-blue-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold">Layanan Surat</h1>
        <p class="mt-2 text-blue-100">Pilih jenis surat yang Anda butuhkan dan isi formulir Google Form yang tersedia.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($letterTypes as $type)
        <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-semibold text-gray-900">{{ $type->name }}</h3>
                @if($type->description)
                <p class="text-gray-600 mt-2">{{ $type->description }}</p>
                @endif
            </div>
            <a href="{{ $type->gform_link }}" target="_blank" 
               class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded text-center hover:bg-blue-700 transition">
                Ajukan via Google Form ↗
            </a>
        </div>
        @empty
        <p class="text-gray-600">Belum ada jenis surat tersedia.</p>
        @endforelse
    </div>
</div>
@endsection