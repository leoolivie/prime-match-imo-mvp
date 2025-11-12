@php
    $conciergeLink = 'https://wa.me/5514996845854?text=' . rawurlencode('Olá concierge Prime Match Imo, gostaria de conversar sobre novas oportunidades.');
@endphp

<nav class="relative z-50 border-b border-white/10 bg-lux-black/90 backdrop-blur-xl">
    <div class="absolute inset-0 opacity-70" style="background: radial-gradient(circle at top left, rgba(255,215,0,0.18), transparent 55%), radial-gradient(circle at bottom right, rgba(59,130,246,0.25), transparent 55%);"></div>
    <div class="relative lux-container">
        <div class="flex h-20 items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="group flex items-center gap-4 text-lux-ice">
                <span class="flex h-12 w-12 items-center justify-center rounded-3xl border border-white/15 bg-white/5 text-lg font-semibold tracking-wide shadow-[0_0_25px_rgba(255,215,0,0.25)] transition group-hover:border-lux-gold/60 group-hover:text-white">PM</span>
                <div>
                    <p class="text-lg font-semibold tracking-wide text-white">Prime Match Imo</p>
                    <p class="text-[11px] uppercase tracking-[0.35em] text-white/60">Plataforma imobiliária inteligente</p>
                </div>
            </a>
            <div class="hidden lg:flex items-center gap-8 text-sm font-medium text-white/70">
                <a href="{{ route('landing.businessman') }}" class="transition hover:text-white">Empresários</a>
                <a href="{{ route('landing.investor') }}" class="transition hover:text-white">Investidores</a>
                <a href="{{ route('landing.master') }}" class="transition hover:text-white">Master</a>
                <a href="{{ route('home') }}#concierge" class="transition hover:text-white">Concierge</a>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ $conciergeLink }}" target="_blank" rel="noopener" class="lux-outline-button whitespace-nowrap">
                    Falar com concierge
                </a>
                <a href="{{ auth()->check() ? route('investor.search') : route('register') }}" class="lux-gold-button whitespace-nowrap">
                    Ativar busca prime
                </a>
                @auth
                    <span class="hidden sm:inline-flex items-center rounded-full border border-white/15 bg-white/5 px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-white/60">
                        {{ strtoupper(Auth::user()->role) }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="hidden sm:inline">
                        @csrf
                        <button type="submit" class="lux-outline-button px-5 py-2 text-xs uppercase tracking-[0.25em]">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 rounded-full border border-white/20 px-5 py-2 text-sm font-semibold text-white/80 transition hover:border-lux-gold/60 hover:text-white">
                        Entrar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
