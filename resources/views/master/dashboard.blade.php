@extends('layouts.app')

@section('title', 'Dashboard Master Prime')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-16">
        <header class="lux-card-dark">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-5">
                    <span class="lux-badge-gold">Master dashboard</span>
                    <div class="space-y-4">
                        <h1 class="font-poppins text-4xl font-semibold text-white">Orquestração premium da plataforma</h1>
                        <p class="max-w-2xl text-white/70">Acompanhe usuários, imóveis, planos e concierge em um painel grafite com cartões dourados, atalhos "ver como" e controles avançados de permissão.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('master.users') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Gerenciar usuários</a>
                        <a href="{{ route('master.properties') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Gerenciar imóveis</a>
                        <a href="{{ route('master.partners') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Parceiros prime</a>
                        <a href="{{ route('master.featured-properties.index') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Imóveis em destaque</a>
                        <a href="{{ route('master.opportunities.edit') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Oportunidades Prime</a>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Usuários</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['total_users']) }}</span>
                        <span class="text-white/40">Investidores {{ number_format($stats['investors']) }}</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Imóveis</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['total_properties']) }}</span>
                        <span class="text-white/40">Ativos {{ number_format($stats['active_properties']) }}</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Assinaturas</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['total_subscriptions']) }}</span>
                        <span class="text-white/40">Planos premium</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">WhatsApp (30d)</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['clicks_30']) }}</span>
                        <span class="text-white/40">Cliques concierge</span>
                    </div>
                </div>
            </div>
        </header>

        <section class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="lux-card-dark space-y-6">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-2xl font-semibold text-white">Atalhos dourados</h2>
                    <div class="flex flex-wrap gap-2 text-xs uppercase tracking-[0.3em] text-white/60">
                        <span class="lux-tab lux-tab-active">Planos</span>
                        <span class="lux-tab">Pagamentos</span>
                        <span class="lux-tab">Imóveis</span>
                        <span class="lux-tab">Alertas</span>
                    </div>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="lux-card-gold">
                        <h3 class="text-lg font-semibold text-white">Radar de performance</h3>
                        <p class="mt-2 text-sm text-white/70">KPIs de matches, concierge e conversão em tempo real com glow dourado.</p>
                    </div>
                    <div class="lux-card-gold">
                        <h3 class="text-lg font-semibold text-white">Gerar relatórios</h3>
                        <p class="mt-2 text-sm text-white/70">Exportação com marca customizada, insights de IA e trilha de auditoria.</p>
                    </div>
                    <div class="lux-card-gold">
                        <h3 class="text-lg font-semibold text-white">Ajustes de marca/IA</h3>
                        <p class="mt-2 text-sm text-white/70">Controle voice & tone, parâmetros de IA e permissões para criação de imóveis.</p>
                    </div>
                    <div class="lux-card-gold">
                        <h3 class="text-lg font-semibold text-white">Segmentação</h3>
                        <p class="mt-2 text-sm text-white/70">Filtre usuários por perfil, status e plano, aplique badges douradas e war rooms.</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('master.dashboard') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]" target="_blank">Ver como master</a>
                    <a href="{{ route('investor.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]" target="_blank">Ver como investidor</a>
                    <a href="{{ route('businessman.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]" target="_blank">Ver como empresário</a>
                    <a href="{{ route('broker.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]" target="_blank">Ver como concierge</a>
                </div>
            </div>
            <div class="space-y-6">
                <div class="lux-card-dark">
                    <h3 class="text-lg font-semibold text-white">Concierge master</h3>
                    <p class="mt-2 text-sm text-white/60">Integração direta com WhatsApp 14 99684-5854, telefone e vídeo. Cada ação registra intenção na API e libera resumo da oportunidade.</p>
                    <div class="mt-4 grid gap-3">
                        <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, preciso de suporte master.') }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">WhatsApp master</a>
                        <a href="tel:+5514996845854" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Telefone</a>
                        <a href="mailto:concierge@primematchimo.com.br" class="lux-outline-button text-xs uppercase tracking-[0.3em]">E-mail</a>
                    </div>
                </div>
                <div class="lux-card-dark">
                    <h3 class="text-lg font-semibold text-white">Alertas críticos</h3>
                    <ul class="mt-4 space-y-3 text-sm text-white/60">
                        <li>• Visitas nos últimos 30 dias: {{ number_format($stats['visits_30']) }}</li>
                        <li>• Cliques concierge nos últimos 30 dias: {{ number_format($stats['clicks_30']) }}</li>
                        <li>• Conversão agregada: {{ number_format($stats['conversion'], 1) }}%</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="lux-card-dark">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Usuários recentes</h2>
                    <a href="{{ route('master.users.create') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">+ Usuário</a>
                </div>
                <div class="mt-6 space-y-4">
                    @forelse($recentUsers as $user)
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <p class="text-base font-semibold text-white">{{ $user->name }}</p>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $user->email }}</p>
                                </div>
                                <span class="lux-property-status text-white/70">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span>
                            </div>
                            <p class="mt-3 text-xs text-white/50">Criado {{ $user->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-white/60">Nenhum usuário recente.</p>
                    @endforelse
                </div>
            </div>
            <div class="lux-card-dark">
                <h2 class="text-xl font-semibold text-white">Imóveis recentes</h2>
                <div class="mt-6 space-y-4">
                    @forelse($recentProperties as $property)
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <p class="text-base font-semibold text-white">{{ $property->title }}</p>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $property->city }} • {{ $property->state }}</p>
                                    <p class="text-xs text-white/50">Owner: {{ $property->owner->name }}</p>
                                </div>
                                <span class="lux-property-status text-white/70">{{ ucfirst($property->status) }}</span>
                            </div>
                            <p class="mt-3 text-sm text-white/60">Valor: R$ {{ number_format($property->price, 2, ',', '.') }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-white/60">Nenhum imóvel cadastrado recentemente.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
