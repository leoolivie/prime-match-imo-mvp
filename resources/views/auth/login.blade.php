@extends('layouts.app')

@section('title', 'Login - Prime Match Imo')

@section('content')
<section class="lux-hero min-h-screen flex items-center">
    <div class="lux-container py-20 lg:py-28">
        <div class="grid gap-14 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-8 text-white text-center lg:text-left">
                <span class="lux-badge-gold">Central Master</span>
                <h1 class="font-poppins text-4xl font-semibold sm:text-5xl">
                    Acesso exclusivo aos serviços concierge da Prime Match Imo
                </h1>
                <p class="max-w-2xl text-base text-white/70 sm:text-lg">
                    Faça login para acompanhar curadorias, gerenciar tickets e receber alertas prioritários sobre ativos de luxo validados pelo Master.
                </p>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="lux-card-surface">
                        <p class="text-[11px] uppercase tracking-[0.3em] text-white/50">Concierge</p>
                        <p class="mt-2 text-xl font-semibold text-white">WhatsApp 24/7</p>
                        <p class="mt-1 text-sm text-white/60">Resposta instantânea para negociações urgentes.</p>
                    </div>
                    <div class="lux-card-surface">
                        <p class="text-[11px] uppercase tracking-[0.3em] text-white/50">Vitrine</p>
                        <p class="mt-2 text-xl font-semibold text-white">Ativos exclusivos</p>
                        <p class="mt-1 text-sm text-white/60">Seleção manual validada pelo Master.</p>
                    </div>
                </div>
            </div>

            <div class="lux-card-dark space-y-8 rounded-[32px] border border-white/10 bg-[#060607]/80 p-10 shadow-[0_30px_60px_rgba(0,0,0,0.45)]">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Entrada segura</p>
                    <h2 class="mt-2 text-3xl font-semibold text-white">Login Prime Match</h2>
                </div>

                @if(session('status'))
                    <div class="rounded-2xl border border-lux-gold/40 bg-lux-gold/10 p-4 text-sm text-white">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div class="space-y-2">
                        <label for="email" class="text-xs uppercase tracking-[0.3em] text-white/60">E-mail</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:border-lux-gold focus:outline-none focus:ring-0 @error('email') border-red-500 @enderror"
                        >
                        @error('email')
                            <p class="text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="text-xs uppercase tracking-[0.3em] text-white/60">Senha</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            class="w-full rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:border-lux-gold focus:outline-none focus:ring-0"
                        >
                        @error('password')
                            <p class="text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between text-xs uppercase tracking-[0.3em] text-white/60">
                        <label class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                class="h-4 w-4 rounded border border-white/30 bg-white/5 text-lux-gold focus:ring-0"
                            >
                            Lembrar-me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-lux-gold hover:text-white">
                                Esqueceu a senha?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="lux-gold-button w-full text-sm uppercase tracking-[0.3em]">
                        Entrar
                    </button>
                </form>

                <p class="text-center text-sm text-white/50">
                    Não tem uma conta?
                    <a href="{{ route('register') }}" class="text-white font-semibold underline decoration-lux-gold/50 hover:text-lux-gold">
                        Cadastre-se
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
