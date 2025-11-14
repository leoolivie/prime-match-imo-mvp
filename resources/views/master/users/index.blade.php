@extends('layouts.app')

@section('title', 'Master • Usuários Prime')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-12">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="lux-badge-gold">Master • Usuários</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Comando total de credenciais prime</h1>
                <p class="text-sm text-white/60">Visualize roles, status e planos de cada perfil. Acione concierge ou altere permissões instantaneamente.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('master.users.create') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">+ Usuário</a>
                <a href="{{ route('master.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Dashboard</a>
            </div>
        </div>

        <div class="space-y-6">
            @forelse($users as $user)
                <article class="lux-card-dark space-y-5">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="space-y-2">
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $user->email }}</p>
                            <h2 class="text-2xl font-semibold text-white">{{ $user->name }}</h2>
                            <div class="flex flex-wrap gap-3 text-xs uppercase tracking-[0.3em] text-white/60">
                                <span class="lux-badge-outline">{{ strtoupper(str_replace('_', ' ', $user->role)) }}</span>
                                <span class="lux-badge-outline">{{ $user->active ? 'ATIVO' : 'INATIVO' }}</span>
                                @if($user->phone)
                                    <span class="lux-badge-outline">{{ $user->phone }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-right text-sm text-white/60">
                            <p>Criação: {{ $user->created_at->format('d/m/Y H:i') }}</p>
                            <p>Atualização: {{ $user->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-5 sm:grid-cols-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Imóveis</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ $user->properties_count }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Planos ativos</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ $user->subscriptions_count }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Concierge</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ $user->role === 'master' ? 'Prioridade' : 'Standard' }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Status</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ $user->active ? 'Liberado' : 'Bloqueado' }}</p>
                        </div>
                    </div>

                    @if($user->isBusinessman())
                        @php
                            $approvalStatus = $user->hasApprovedPropertyAccess();
                            $requestedAt = optional($user->property_access_requested_at);
                            $grantedAt = optional($user->property_access_granted_at);
                        @endphp
                        <div class="rounded-2xl border border-amber-400/25 bg-amber-500/10 p-5 text-sm text-white/80">
                            <div class="flex flex-wrap items-start justify-between gap-4">
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.3em] text-amber-200/80">Liberação de imóveis</p>
                                    <p class="text-lg font-semibold text-white">{{ $approvalStatus ? 'Liberado para publicar' : 'Em validação master' }}</p>
                                    <p>CRECI: <span class="font-medium text-white">{{ $user->creci ?? 'não informado' }}</span></p>
                                    <p>CPF/CNPJ: <span class="font-medium text-white">{{ $user->cpf_cnpj ?? 'não informado' }}</span> • UF: <span class="font-medium text-white">{{ $user->businessman_state ?? '--' }}</span></p>
                                    <p class="text-xs text-white/60">
                                        Solicitação: {{ $requestedAt ? $requestedAt->format('d/m/Y H:i') : '—' }}
                                        @if($approvalStatus)
                                            • Liberação: {{ $grantedAt ? $grantedAt->format('d/m/Y H:i') : '—' }}
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

                    <div class="flex flex-wrap gap-3">
                        <a href="mailto:{{ $user->email }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">E-mail direto</a>
                        @if($user->phone)
                            <a href="https://wa.me/{{ preg_replace('/\D+/', '', $user->phone) }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.3em]">WhatsApp</a>
                        @endif
                        <a href="{{ route('master.users.edit', $user) }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Editar</a>
                        <form action="{{ route('master.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Deseja remover este usuário?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="lux-outline-button text-xs uppercase tracking-[0.3em] text-red-200 hover:text-white">Remover</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                    Nenhum usuário cadastrado. Gere credenciais pelo botão "+ Usuário" para ativar a operação master.
                </div>
            @endforelse
        </div>

        <div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
