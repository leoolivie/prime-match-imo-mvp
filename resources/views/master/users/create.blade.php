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

            <form action="{{ route('master.users.store') }}" method="POST" class="space-y-6" x-data="{ role: '{{ old('role', 'investor') }}' }">
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
                        <select name="role" required x-model="role" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                            <option value="investor" @selected(old('role', 'investor') === 'investor')>Investidor</option>
                            <option value="businessman" @selected(old('role') === 'businessman')>Empresário</option>
                            <option value="prime_broker" @selected(old('role') === 'prime_broker')>Prime broker</option>
                            <option value="master" @selected(old('role') === 'master')>Master</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Status</label>
                        <div class="mt-2 flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                            <input type="hidden" name="active" value="0" />
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

                <div x-show="role === 'businessman'" x-cloak class="space-y-4 rounded-3xl border border-white/10 bg-white/5 p-5">
                    <div class="space-y-1">
                        <p class="text-xs uppercase tracking-[0.3em] text-white/60">Verificação CRECI</p>
                        <p class="text-sm text-white/60">Informe os dados regulatórios para liberar (ou não) o cadastro de imóveis imediatamente.</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">CRECI</label>
                            <input name="creci" value="{{ old('creci') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none @error('creci') border-red-500 @enderror" />
                            @error('creci')
                                <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">CPF/CNPJ</label>
                            <input name="cpf_cnpj" value="{{ old('cpf_cnpj') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none @error('cpf_cnpj') border-red-500 @enderror" />
                            @error('cpf_cnpj')
                                <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">UF</label>
                            <input name="businessman_state" maxlength="2" value="{{ old('businessman_state') }}" class="mt-2 w-full uppercase rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none @error('businessman_state') border-red-500 @enderror" />
                            @error('businessman_state')
                                <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2 flex items-center gap-3 rounded-2xl border border-white/10 bg-white/10 px-4 py-3">
                            <input type="hidden" name="can_manage_properties" value="0" />
                            <input type="checkbox" name="can_manage_properties" value="1" id="can_manage_properties" class="h-4 w-4 rounded border-white/20 bg-transparent text-lux-gold focus:ring-lux-gold" @checked(old('can_manage_properties')) />
                            <label for="can_manage_properties" class="text-sm text-white/70">Liberar imediatamente o cadastro de imóveis</label>
                        </div>
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
