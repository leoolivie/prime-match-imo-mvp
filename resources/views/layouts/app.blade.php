<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Prime Match Imo')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-monogram.png') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('head')
</head>
<body x-data="{}" class="font-inter antialiased bg-lux-black text-lux-ice">
    @include('layouts.navbar')

    <main class="min-h-screen">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="rounded-2xl border border-emerald-400/30 bg-emerald-500/15 px-4 py-3 text-sm font-medium text-emerald-200">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="rounded-2xl border border-red-400/30 bg-red-500/15 px-4 py-3 text-sm font-medium text-red-200">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @include('layouts.footer')

    @stack('scripts')
</body>
</html>
