<?php

use App\Models\CitizenInput;
use App\Models\LetterType;
use App\Models\News;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $latestNews = News::where('status', 'published')
        ->where('published_at', '<=', now())  // 🔥 hindari jadwal masa depan
        ->orderBy('published_at', 'desc')
        ->take(3)
        ->get();

    // Ambil data Lurah dari tabel struktur organisasi
    $lurah = OrganizationMember::where(function ($query) {
        $query->where('position', 'like', '%Lurah%')
            ->orWhere('position', 'like', '%Kepala Kelurahan%');
    })->first();

    return view('public.home', compact('latestNews', 'lurah'));
})->name('home');

Route::get('/surat', function (Request $request) {
    $search = $request->input('search');
    $letterTypes = LetterType::where('is_active', true)
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        })
        ->paginate(6);  // 6 surat per halaman

    return view('public.surat', compact('letterTypes'));
})->name('surat');

Route::get('/berita', function () {
    $news = News::where('status', 'published')
        ->where('published_at', '<=', now())  // 🔥 hanya yang sudah waktunya
        ->orderBy('published_at', 'desc')
        ->paginate(9);
    return view('public.berita.index', compact('news'));
})->name('berita.index');

Route::get('/berita/{slug}', function ($slug) {
    $news = News::where('slug', $slug)
        ->where('status', 'published')
        ->where('published_at', '<=', now())
        ->firstOrFail();

    $relatedNews = News::where('status', 'published')
        ->where('published_at', '<=', now())
        ->where('id', '!=', $news->id)
        ->orderBy('published_at', 'desc')
        ->take(3)
        ->get();

    return view('public.berita.show', compact('news', 'relatedNews'));
})->name('berita.show');

Route::get('/masukan', function () {
    return view('public.masukan');
})->name('masukan');

Route::post('/masukan', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email',
        'phone' => 'nullable|string|max:20',
        'message' => 'required|string',
    ]);
    CitizenInput::create($validated);
    return redirect()->route('masukan')->with('success', 'Masukan berhasil dikirim.');
})->name('masukan.store');

Route::get('/struktur', function () {
    $members = OrganizationMember::with('children')->get();
    return view('public.struktur', compact('members'));
})->name('struktur');

Route::get('/tentang', function () {
    $tentangDesc = \App\Models\Setting::where('key', 'tentang_description')->value('value') ?? '';
    $visi = \App\Models\Setting::where('key', 'visi')->value('value') ?? '';
    $misi = \App\Models\Setting::where('key', 'misi')->value('value') ?? '';
    $alamat = \App\Models\Setting::where('key', 'alamat')->value('value') ?? '';

    $lurah = \App\Models\OrganizationMember::where('position', 'like', '%lurah%')
        ->orWhere('position', 'like', '%kepala desa%')
        ->first();

    return view('public.tentang', compact('tentangDesc', 'visi', 'misi', 'alamat', 'lurah'));
})->name('tentang');
