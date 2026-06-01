<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Desa Sejahtera')</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-DwAU_20J.css') }}">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
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
    <script src="{{ asset('build/assets/app.js') }}" defer></script>
</body>
</html>