@extends('layouts.app')

@section('title', 'Dashboard do Empresário Prime')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-16">
        <header class="lux-card-dark">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-5">
                    <span class="lux-badge-gold">Empresário prime</span>
                    <div class="space-y-4">
                        <h1 class="font-poppins text-4xl font-semibold text-white">Seu hub premium para ativar imóveis com glow dourado</h1>
                        <p class="max-w-2xl text-white/70">Cadastre imóveis com branding cinematográfico, acompanhe métricas em tempo real e acione o concierge para gerar matches instantâneos com investidores.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('businessman.property.create') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Cadastrar imóvel</a>
                        <a href="{{ route('businessman.properties') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Gerenciar portfólio</a>
                        <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, quero ativar divulgação para meus imóveis.') }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Concierge dedicado</a>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Imóveis</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['total_properties']) }}</span>
                        <span class="text-white/40">Portfólio total</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Ativos</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['active_properties']) }}</span>
                        <span class="text-white/40">Disponíveis agora</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Leads</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['total_leads']) }}</span>
                        <span class="text-white/40">Matches gerados</span>
                    </div>
                </div>
            </div>
        </header>

        <section class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="lux-card-dark space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-white">Minha assinatura prime</h2>
                    <a href="{{ route('businessman.plans') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver planos</a>
                </div>
                @if($subscription)
                    <div class="grid gap-4 rounded-2xl border border-lux-gold/40 bg-lux-gold/10 p-6 text-white shadow-lux-glow sm:grid-cols-2">
                        <div class="space-y-2">
                            <p class="text-xs uppercase tracking-[0.3em] text-white/70">Plano</p>
                            <h3 class="text-2xl font-semibold text-white">{{ $subscription->plan->name }}</h3>
                            <p class="text-sm text-white/70">Ativo até {{ $subscription->end_date->format('d/m/Y') }}</p>
                        </div>
                        <div class="space-y-2 text-sm text-white/80">
                            <p>Investimento: <span class="font-semibold">R$ {{ number_format($subscription->plan->price, 2, ',', '.') }}</span> / {{ $subscription->plan->period === 'monthly' ? 'mês' : ($subscription->plan->period === 'quarterly' ? 'trimestre' : 'ano') }}</p>
                            <p>
                                @if($subscription->plan->isUnlimited())
                                    Imóveis ilimitados
                                @else
                                    {{ $subscription->remaining_properties }} de {{ $subscription->plan->property_limit }} imóveis disponíveis
                                @endif
                            </p>
                        </div>
                    </div>
                @else
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 text-white/70">
                        <p class="text-sm">Você ainda não possui uma assinatura ativa. Conheça os planos com glow dourado e concierge dedicado.</p>
                        <a href="{{ route('businessman.plans') }}" class="mt-4 inline-flex items-center justify-center rounded-full bg-lux-gold px-6 py-3 text-sm font-semibold text-lux-black shadow-lux-glow">Escolher plano</a>
                    </div>
                @endif
            </div>
            <div class="space-y-6">
                <div class="lux-card-dark">
                    <h3 class="text-lg font-semibold text-white">Simulador de ROI</h3>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2">
                        <div class="lux-stat-bubble">
                            <span class="text-white/60">Receita potencial</span>
                            <span class="text-2xl font-semibold text-white">R$ 4,2M</span>
                            <span class="text-white/40">Ciclo de 12 meses</span>
                        </div>
                        <div class="lux-stat-bubble">
                            <span class="text-white/60">Lift concierge</span>
                            <span class="text-2xl font-semibold text-white">+27%</span>
                            <span class="text-white/40">Conversão acelerada</span>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-white/60">Ajuste ticket médio, taxa de ocupação e investimento em concierge para projetar crescimento e VGV com glow prime.</p>
                </div>
                <div class="lux-card-dark">
                    <h3 class="text-lg font-semibold text-white">Fluxos concierge</h3>
                    <p class="mt-2 text-sm text-white/60">Cada ação registra intenção na API e abre o canal apropriado com resumo da oportunidade pronto para o investidor.</p>
                    <div class="mt-4 grid gap-3">
                        <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, preciso ativar campanha para meu novo imóvel.') }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Acionar concierge</a>
                        <a href="mailto:concierge@primematchimo.com.br" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Enviar briefing</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="space-y-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-white">Imóveis recentes</h2>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('businessman.property.create') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">+ Novo imóvel</a>
                    <a href="{{ route('businessman.properties') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver todos</a>
                </div>
            </div>
            <div class="lux-grid-cards">
                @forelse($properties as $property)
                    <article class="lux-property-card">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $property->city }} • {{ $property->state }}</p>
                                <h3 class="mt-2 text-xl font-semibold text-white">{{ $property->title }}</h3>
                            </div>
                            <span class="lux-property-status text-white/70">{{ ucfirst($property->status) }}</span>
                        </div>
                        <p class="text-sm text-white/60">{{ \Illuminate\Support\Str::limit($property->description, 160) }}</p>
                        <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</p>
                                <p class="mt-1 text-lg font-semibold text-white">R$ {{ number_format($property->price, 2, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Dorms</p>
                                <p class="mt-1 text-lg font-semibold text-white">{{ $property->bedrooms ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Banheiros</p>
                                <p class="mt-1 text-lg font-semibold text-white">{{ $property->bathrooms ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Área</p>
                                <p class="mt-1 text-lg font-semibold text-white">{{ $property->area ? number_format($property->area, 0, ',', '.') . ' m²' : '—' }}</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('businessman.property.edit', $property) }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Editar</a>
                            <form method="POST" action="{{ route('businessman.property.destroy', $property) }}" onsubmit="return confirm('Confirma exclusão deste imóvel prime?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Remover</button>
                            </form>
                            @if($property->leads_count > 0)
                                <span class="lux-badge-outline">{{ $property->leads_count }} {{ $property->leads_count === 1 ? 'lead' : 'leads' }}</span>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                        Você ainda não cadastrou imóveis. Ative seu primeiro anúncio com brilho dourado e alcance investidores imediatamente.
                    </div>
                @endforelse
            </div>
            <div>
                {{ $properties->links() }}
            </div>
        </section>
    </div>
</div>
@endsection
