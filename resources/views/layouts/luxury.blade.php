<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $title ?? config('app.name') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/luxury.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0F1115] text-[#F6F5F2] antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="bg-gradient-to-b from-black/60 to-transparent">
            <div class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#C6A86B] to-[#b5894a] rounded-full flex items-center justify-center text-black font-semibold">PM</div>
                        <div>
                            <div class="font-playfair text-xl">{{ config('app.name') }}</div>
                            <div class="text-xs text-[#D9D6CB]">Imóveis de alto padrão</div>
                        </div>
                    </a>
                </div>

                <nav class="hidden md:flex items-center gap-6 text-[#D9D6CB]">
                    <a href="#" class="hover:text-white">Propriedades</a>
                    <a href="#" class="hover:text-white">Serviços</a>
                    <a href="#" class="hover:text-white">Contato</a>
                    <a href="#" class="px-4 py-2 border border-[#C6A86B]/40 rounded-md hover:bg-[#C6A86B]/10">Área do Cliente</a>
                </nav>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-6 py-12">
                {{-- Support both component slot and traditional section/yield --}}
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? $content ?? '' }}
                @endif
            </div>
        </main>

        <footer class="border-t border-neutral-800 py-8">
            <div class="max-w-7xl mx-auto px-6 flex items-center justify-between text-sm text-[#BFBAB0]">
                <div>&copy; {{ date('Y') }} {{ config('app.name') }} — Todos os direitos reservados</div>
                <div>Desenvolvido por equipe interna</div>
            </div>
        </footer>
    </div>
</body>
</html>
