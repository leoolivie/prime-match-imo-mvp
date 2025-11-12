<nav class="relative z-50 border-b border-white/10 bg-[#050B2C]/90 backdrop-blur-xl">
    <div class="absolute inset-0 opacity-50" style="background: radial-gradient(circle at top left, rgba(59,130,246,0.35), transparent 45%), radial-gradient(circle at bottom right, rgba(124,58,237,0.35), transparent 45%);"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 text-white">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10 text-lg font-semibold">PM</span>
                <div>
                    <p class="text-lg font-semibold tracking-wide">Prime Match Imo</p>
                    <p class="text-xs uppercase tracking-[0.35em] text-white/60">Matchmaking imobiliário</p>
                </div>
            </a>
            <div class="flex items-center gap-3">
                @auth
                    <span class="hidden sm:inline-flex items-center rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-medium text-white/80">
                        {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-5 py-2 text-sm font-semibold text-white transition hover:border-white hover:bg-white/10">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-5 py-2 text-sm font-semibold text-white/80 transition hover:border-white hover:text-white">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-2 text-sm font-semibold text-[#050B2C] shadow-lg shadow-blue-500/20 transition hover:bg-blue-50">
                        Criar conta
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
