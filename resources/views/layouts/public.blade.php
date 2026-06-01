<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Desa Sejahtera')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    {{-- Navbar --}}
    @include('partials._navbar')

    {{-- Konten Utama --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials._footer')
</body>
</html>