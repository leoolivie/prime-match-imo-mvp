@php
    $canAccessMaster = auth()->check() && auth()->user()->email === 'leoolivie05@gmail.com';
@endphp

<nav class="relative z-50 border-b border-white/10 bg-[#0B0B0B]/95 backdrop-blur-xl">
    <div class="absolute inset-0 opacity-60" style="background: radial-gradient(circle at top left, rgba(203,161,53,0.2), transparent 55%), radial-gradient(circle at bottom right, rgba(33,33,33,0.45), transparent 55%);"></div>
    <div class="relative lux-container">
        <div class="flex h-20 items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="group flex items-center gap-4 text-white">
                <span class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-3xl border border-white/15 bg-white/5 shadow-[0_0_25px_rgba(255,215,0,0.25)] transition group-hover:border-lux-gold/60">
                    <img src="{{ asset('images/logo-monogram.png') }}" alt="Prime Match Imo" class="h-10 w-10 object-contain" loading="lazy">
                </span>
                <div class="leading-tight">
                    <p class="text-lg font-semibold tracking-wide text-white">Prime Match Imo</p>
                </div>
            </a>
            <div class="hidden items-center gap-3 lg:flex">
                <a href="{{ route('investor.catalog') }}" class="lux-gold-button whitespace-nowrap text-xs font-semibold uppercase tracking-[0.25em]">
                    Investidor
                </a>
                <a href="{{ route('landing.businessman') }}" class="lux-outline-button whitespace-nowrap text-xs font-semibold uppercase tracking-[0.25em]">
                    Empresário
                </a>
                @if($canAccessMaster)
                    <a href="{{ route('landing.master') }}" class="lux-outline-button whitespace-nowrap text-xs font-semibold uppercase tracking-[0.25em]">
                        Master
                    </a>
                @endif
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('landing.opportunities') }}" class="lux-outline-button whitespace-nowrap text-xs uppercase tracking-[0.25em]">
                    Oportunidades Prime
                </a>
                @auth
                    @php
                        $roleLabel = match (Auth::user()->role) {
                            'businessman' => 'Empresário',
                            'investor' => 'Investidor',
                            'master' => 'Master',
                            default => strtoupper(Auth::user()->role),
                        };
                    @endphp
                    <span class="hidden sm:inline-flex items-center rounded-full border border-white/15 bg-white/5 px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-white/60">
                        {{ strtoupper($roleLabel) }}
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
