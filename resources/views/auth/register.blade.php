@extends('layouts.app')

@section('title', 'Cadastro - Prime Match Imo')

@section('content')
<section class="lux-hero min-h-screen flex items-center">
    <div class="lux-container py-20 lg:py-28">
        <div class="grid gap-14 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-8 text-white text-center lg:text-left">
                <span class="lux-badge-gold">Experiência Prime</span>
                <h1 class="font-poppins text-4xl font-semibold sm:text-5xl">
                    Cadastre-se para acessar o ecossistema concierge da Prime Match Imo
                </h1>
                <p class="max-w-2xl text-base text-white/70 sm:text-lg">
                    Crie sua conta e receba convites para ativos exclusivos, relatórios estratégicos e atendimento Master remoto em um clique.
                </p>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="lux-card-surface">
                        <p class="text-[11px] uppercase tracking-[0.3em] text-white/50">Investidores</p>
                        <p class="mt-2 text-xl font-semibold text-white">Análise premium</p>
                        <p class="mt-1 text-sm text-white/60">Curadoria com scoring financeiro e riscos.</p>
                    </div>
                    <div class="lux-card-surface">
                        <p class="text-[11px] uppercase tracking-[0.3em] text-white/50">Empresários</p>
                        <p class="mt-2 text-xl font-semibold text-white">Exposição Master</p>
                        <p class="mt-1 text-sm text-white/60">Marketplace com concierges dedicados.</p>
                    </div>
                </div>
            </div>

            <div class="lux-card-dark space-y-8 rounded-[32px] border border-white/10 bg-[#060607]/80 p-10 shadow-[0_30px_60px_rgba(0,0,0,0.45)]">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Registro seguro</p>
                    <h2 class="mt-2 text-3xl font-semibold text-white">Criar conta Prime Match</h2>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5" x-data="{ role: '{{ old('role', 'investor') }}' }">
                    @csrf

                    <div class="space-y-2">
                        <label for="name" class="text-xs uppercase tracking-[0.3em] text-white/60">Nome completo</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:border-lux-gold focus:outline-none focus:ring-0 @error('name') border-red-500 @enderror"
                        >
                        @error('name')
                            <p class="text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="text-xs uppercase tracking-[0.3em] text-white/60">E-mail</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:border-lux-gold focus:outline-none focus:ring-0 @error('email') border-red-500 @enderror"
                        >
                        @error('email')
                            <p class="text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="password" class="text-xs uppercase tracking-[0.3em] text-white/60">Senha</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:border-lux-gold focus:outline-none focus:ring-0 @error('password') border-red-500 @enderror"
                            >
                            @error('password')
                                <p class="text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="text-xs uppercase tracking-[0.3em] text-white/60">Confirmar senha</label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:border-lux-gold focus:outline-none focus:ring-0"
                            >
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="role" class="text-xs uppercase tracking-[0.3em] text-white/60">Tipo de conta</label>
                        <select
                            id="role"
                            name="role"
                            required
                            x-model="role"
                            class="w-full rounded-2xl border border-white/10 bg-white px-4 py-3 text-sm text-black focus:border-lux-gold focus:outline-none focus:ring-0 @error('role') border-red-500 @enderror"
                        >
                            <option value="investor" @selected(old('role', 'investor') === 'investor')>Investidor</option>
                            <option value="businessman" @selected(old('role') === 'businessman')>Empresário</option>
                        </select>
                        @error('role')
                            <p class="text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-show="role === 'businessman'" x-cloak class="space-y-4 rounded-3xl border border-white/10 bg-white/5 p-5">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/60">Validação CRECI</p>
                            <p class="mt-1 text-sm text-white/60">Preencha os dados abaixo para que o Master libere o cadastro de imóveis. Validaremos o CRECI antes da primeira publicação.</p>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2 space-y-2">
                                <label for="creci" class="text-xs uppercase tracking-[0.3em] text-white/60">CRECI</label>
                                <input
                                    id="creci"
                                    name="creci"
                                    type="text"
                                    value="{{ old('creci') }}"
                                    class="w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none focus:ring-0 @error('creci') border-red-500 @enderror"
                                >
                                @error('creci')
                                    <p class="text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="cpf_cnpj" class="text-xs uppercase tracking-[0.3em] text-white/60">CPF ou CNPJ</label>
                                <input
                                    id="cpf_cnpj"
                                    name="cpf_cnpj"
                                    type="text"
                                    value="{{ old('cpf_cnpj') }}"
                                    class="w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none focus:ring-0 @error('cpf_cnpj') border-red-500 @enderror"
                                >
                                @error('cpf_cnpj')
                                    <p class="text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="businessman_state" class="text-xs uppercase tracking-[0.3em] text-white/60">UF</label>
                                <input
                                    id="businessman_state"
                                    name="businessman_state"
                                    type="text"
                                    maxlength="2"
                                    value="{{ old('businessman_state') }}"
                                    class="w-full uppercase rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none focus:ring-0 @error('businessman_state') border-red-500 @enderror"
                                >
                                @error('businessman_state')
                                    <p class="text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="phone" class="text-xs uppercase tracking-[0.3em] text-white/60">Telefone (opcional)</label>
                        <input
                            id="phone"
                            name="phone"
                            type="text"
                            placeholder="(11) 99999-9999"
                            value="{{ old('phone') }}"
                            class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:border-lux-gold focus:outline-none focus:ring-0"
                        >
                    </div>

                    <label class="flex items-start gap-3 text-xs uppercase tracking-[0.3em] text-white/60">
                        <input
                            type="checkbox"
                            name="terms"
                            required
                            class="mt-1 h-4 w-4 rounded border border-white/10 bg-white/5 text-lux-gold focus:ring-0"
                        >
                        <span class="leading-relaxed text-white/60">
                            Eu aceito os
                            <a href="#" class="text-lux-gold hover:text-white">termos de uso</a>
                            e
                            <a href="#" class="text-lux-gold hover:text-white">política de privacidade</a>
                        </span>
                    </label>
                    @error('terms')
                        <p class="text-xs text-red-400">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="lux-gold-button w-full text-sm uppercase tracking-[0.3em]">
                        Criar conta
                    </button>
                </form>

                <p class="text-center text-sm text-white/50">
                    Já possui uma conta?
                    <a href="{{ route('login') }}" class="text-white font-semibold underline decoration-lux-gold/50 hover:text-lux-gold">
                        Entrar
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
