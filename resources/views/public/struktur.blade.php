@extends('layouts.public')
@section('title', 'Struktur Organisasi')
@section('content')
<div class="bg-blue-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold">Struktur Organisasi</h1>
        <p class="mt-2 text-blue-100">Pemerintahan Desa Sejahtera</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
    @if($members->isEmpty())
        <p class="text-gray-600">Data belum tersedia.</p>
    @else
        {{-- Level teratas (parent_id = null) --}}
        @foreach($members->whereNull('parent_id')->sortBy('order') as $head)
        <div class="text-center mb-12">
            @if($head->photo)
            <img src="{{ asset('storage/' . $head->photo) }}" class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-blue-600 shadow-lg">
            @endif
            <h3 class="text-xl font-semibold mt-4">{{ $head->name }}</h3>
            <p class="text-blue-600 font-medium">{{ $head->position }}</p>
        </div>

        {{-- Bawahan --}}
        @if($head->children->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
            @foreach($head->children->sortBy('order') as $child)
            <div class="bg-white rounded-xl shadow p-6 text-center">
                @if($child->photo)
                <img src="{{ asset('storage/' . $child->photo) }}" class="w-24 h-24 rounded-full mx-auto object-cover">
                @endif
                <h4 class="font-semibold mt-3">{{ $child->name }}</h4>
                <p class="text-blue-600 text-sm">{{ $child->position }}</p>
            </div>
            @endforeach
        </div>
        @endif
        @endforeach
    @endif
</div>
@endsection