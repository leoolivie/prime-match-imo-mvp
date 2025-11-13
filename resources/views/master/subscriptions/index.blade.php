@extends('layouts.app')

@section('title', 'Master • Assinaturas Prime')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-12">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="lux-badge-gold">Master • Planos</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Controle de assinaturas concierge</h1>
                <p class="text-sm text-white/60">Acompanhe planos ativos, validade e limites de imóveis para cada usuário prime.</p>
            </div>
            <a href="{{ route('master.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Dashboard</a>
        </div>

        <div class="space-y-6">
            @forelse($subscriptions as $subscription)
                <article class="lux-card-dark space-y-5">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $subscription->user->email }}</p>
                            <h2 class="text-2xl font-semibold text-white">{{ $subscription->user->name }}</h2>
                            <p class="text-sm text-white/60">Plano {{ $subscription->plan->name }} • {{ ucfirst($subscription->status) }}</p>
                        </div>
                        <div class="text-right text-sm text-white/60">
                            <p>Início: {{ optional($subscription->start_date)->format('d/m/Y') }}</p>
                            <p>Fim: {{ optional($subscription->end_date)->format('d/m/Y') ?? '—' }}</p>
                        </div>
                    </div>

                    <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-5 sm:grid-cols-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Status</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ ucfirst($subscription->status) }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor mensal</p>
                            <p class="mt-1 text-lg font-semibold text-white">R$ {{ number_format($subscription->plan->price, 2, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Limite imóveis</p>
                            <p class="mt-1 text-lg font-semibold text-white">
                                @if($subscription->plan->isUnlimited())
                                    Ilimitado
                                @else
                                    {{ $subscription->plan->property_limit }}
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Restantes</p>
                            <p class="mt-1 text-lg font-semibold text-white">
                                @php($remaining = $subscription->remaining_properties)
                                {{ $remaining === null ? '∞' : $remaining }}
                            </p>
                        </div>
                    </div>

                    @if($subscription->cancelled_at)
                        <p class="text-sm text-red-200">Cancelado em {{ $subscription->cancelled_at->format('d/m/Y H:i') }}</p>
                    @endif
                </article>
            @empty
                <div class="rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                    Nenhuma assinatura ativa. Assim que empresários contratarem planos, o status aparece aqui para orquestração master.
                </div>
            @endforelse
        </div>

        <div>
            {{ $subscriptions->links() }}
        </div>
    </div>
</div>
@endsection
