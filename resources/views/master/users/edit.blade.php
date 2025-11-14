@extends('layouts.app')

@section('title', 'Master • Editar Usuário')

@section('content')
<div class="py-12">
    <div class="lux-container max-w-4xl space-y-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="lux-badge-gold">Editar credencial</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">{{ $user->name }}</h1>
                <p class="text-sm text-white/60">Ajuste permissões, dados de contato e redefina senha conforme necessidade operacional.</p>
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

            @if($user->isBusinessman())
                @php
                    $approvalStatus = $user->hasApprovedPropertyAccess();
                @endphp
                <div class="mb-6 rounded-2xl border border-amber-400/25 bg-amber-500/10 p-5 text-sm text-white/80">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="space-y-2">
                            <p class="text-xs uppercase tracking-[0.3em] text-amber-200/80">Liberação de imóveis</p>
                            <p class="text-lg font-semibold text-white">{{ $approvalStatus ? 'Empresário liberado' : 'Em validação master' }}</p>
                            <p>CRECI: <span class="font-medium text-white">{{ $user->creci ?? 'não informado' }}</span></p>
                            <p>CPF/CNPJ: <span class="font-medium text-white">{{ $user->cpf_cnpj ?? 'não informado' }}</span> • UF: <span class="font-medium text-white">{{ $user->businessman_state ?? '--' }}</span></p>
                            <p class="text-xs text-white/60">
                                Solicitação: {{ optional($user->property_access_requested_at)?->format('d/m/Y H:i') ?? '—' }}
                                @if($approvalStatus)
                                    • Liberação: {{ optional($user->property_access_granted_at)?->format('d/m/Y H:i') ?? '—' }}
                                @endif
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 sm:flex-row">
                            @if($approvalStatus)
                                <form action="{{ route('master.users.property-access', $user) }}" method="POST" onsubmit="return confirm('Revogar a liberação deste empresário?');">
                                    @csrf
                                    <input type="hidden" name="action" value="revoke">
                                    <button type="submit" class="lux-outline-button text-xs uppercase tracking-[0.3em] text-amber-100">Revogar liberação</button>
                                </form>
                            @else
                                <form action="{{ route('master.users.property-access', $user) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Liberar cadastro de imóveis</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('master.users.update', $user) }}" method="POST" class="space-y-6" x-data="{ role: '{{ old('role', $user->role) }}' }">
                @csrf
                @method('PUT')
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Nome completo</label>
                        <input name="name" value="{{ old('name', $user->name) }}" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">E-mail</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Telefone</label>
                        <input name="phone" value="{{ old('phone', $user->phone) }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Role</label>
                        <select name="role" required x-model="role" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                            <option value="investor" @selected(old('role', $user->role) === 'investor')>Investidor</option>
                            <option value="businessman" @selected(old('role', $user->role) === 'businessman')>Empresário</option>
                            <option value="prime_broker" @selected(old('role', $user->role) === 'prime_broker')>Prime broker</option>
                            <option value="master" @selected(old('role', $user->role) === 'master')>Master</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Status</label>
                        <div class="mt-2 flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                            <input type="hidden" name="active" value="0" />
                            <input type="checkbox" name="active" value="1" id="active" class="h-4 w-4 rounded border-white/20 bg-transparent text-lux-gold focus:ring-lux-gold" @checked(old('active', $user->active)) />
                            <label for="active" class="text-sm text-white/70">Usuário ativo</label>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Nova senha (opcional)</label>
                        <input type="password" name="password" minlength="8" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Deixe em branco para manter" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Confirmar nova senha</label>
                        <input type="password" name="password_confirmation" minlength="8" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Repita se alterar" />
                    </div>
                </div>

                <div x-show="role === 'businessman'" x-cloak class="space-y-4 rounded-3xl border border-white/10 bg-white/5 p-5">
                    <div class="space-y-1">
                        <p class="text-xs uppercase tracking-[0.3em] text-white/60">Dados regulatórios</p>
                        <p class="text-sm text-white/60">Atualize CRECI, CPF/CNPJ e UF quando o empresário enviar novas informações.</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">CRECI</label>
                            <input name="creci" value="{{ old('creci', $user->creci) }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none @error('creci') border-red-500 @enderror" />
                            @error('creci')
                                <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">CPF/CNPJ</label>
                            <input name="cpf_cnpj" value="{{ old('cpf_cnpj', $user->cpf_cnpj) }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none @error('cpf_cnpj') border-red-500 @enderror" />
                            @error('cpf_cnpj')
                                <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">UF</label>
                            <input name="businessman_state" maxlength="2" value="{{ old('businessman_state', $user->businessman_state) }}" class="mt-2 w-full uppercase rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none @error('businessman_state') border-red-500 @enderror" />
                            @error('businessman_state')
                                <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('master.users') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Cancelar</a>
                    <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
