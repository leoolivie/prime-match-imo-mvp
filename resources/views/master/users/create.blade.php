@extends('layouts.app')

@section('title', 'Master • Novo Usuário')

@section('content')
<div class="py-12">
    <div class="lux-container max-w-4xl space-y-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="lux-badge-gold">Criar credencial</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Novo usuário master</h1>
                <p class="text-sm text-white/60">Defina role, ativação e senha temporária. O usuário pode alterar depois pelo fluxo padrão.</p>
            </div>
            <a href="{{ route('master.users') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Voltar</a>
        </div>

        <div class="lux-card-dark">
            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-red-400/30 bg-red-500/15 px-4 py-3 text-sm text-red-200">
                    <ul class="list-disc space-y-1 pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('master.users.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Nome completo</label>
                        <input name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Nome e sobrenome" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="email@primematchimo.com.br" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Telefone</label>
                        <input name="phone" value="{{ old('phone') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="(00) 00000-0000" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Role</label>
                        <select name="role" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                            <option value="investor" @selected(old('role') === 'investor')>Investidor</option>
                            <option value="businessman" @selected(old('role') === 'businessman')>Empresário</option>
                            <option value="prime_broker" @selected(old('role') === 'prime_broker')>Prime broker</option>
                            <option value="master" @selected(old('role') === 'master')>Master</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Status</label>
                        <div class="mt-2 flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                            <input type="checkbox" name="active" value="1" id="active" class="h-4 w-4 rounded border-white/20 bg-transparent text-lux-gold focus:ring-lux-gold" @checked(old('active', true)) />
                            <label for="active" class="text-sm text-white/70">Usuário ativo (acesso imediato)</label>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Senha</label>
                        <input type="password" name="password" required minlength="8" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Senha temporária" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Confirmar senha</label>
                        <input type="password" name="password_confirmation" required minlength="8" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Repita a senha" />
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('master.users') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Cancelar</a>
                    <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Criar usuário</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
