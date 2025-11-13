@php
    use App\Support\ConciergeLink;
    $conciergeLink = ConciergeLink::build('investidor_card', [
        'city' => 'Curadoria concierge',
        'type' => 'matching prime',
        'budget_min' => 5000000,
    ], [
        'user_type' => 'investidor',
        'source' => 'navbar',
    ]);
    $canAccessMaster = auth()->check() && auth()->user()->email === 'leoolivie05@gmail.com';
@endphp

<nav class="relative z-50 border-b border-white/10 bg-[#0B0B0B]/95 backdrop-blur-xl">
    <div class="absolute inset-0 opacity-60" style="background: radial-gradient(circle at top left, rgba(203,161,53,0.2), transparent 55%), radial-gradient(circle at bottom right, rgba(33,33,33,0.45), transparent 55%);"></div>
    <div class="relative lux-container">
        <div class="flex h-20 items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="group flex items-center gap-4 text-white">
                <span class="flex h-12 w-12 items-center justify-center rounded-3xl border border-white/15 bg-white/5 text-lg font-semibold tracking-wide shadow-[0_0_25px_rgba(255,215,0,0.25)] transition group-hover:border-lux-gold/60 group-hover:text-white">PM</span>
                <div class="leading-tight">
                    <p class="text-lg font-semibold tracking-wide text-white">Prime Match Imo</p>
                    <p class="text-xs uppercase tracking-[0.35em] text-white/50">Concierge único · WhatsApp</p>
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
                <a href="{{ $conciergeLink }}" target="_blank" rel="noopener" class="lux-outline-button whitespace-nowrap text-xs uppercase tracking-[0.25em]">
                    Falar com o concierge
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
