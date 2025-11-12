@extends('layouts.app')

@section('title', 'Empresários - Prime Match Imo')

@section('content')
    <section class="lux-hero">
        <div class="lux-container py-20">
            <div class="grid gap-12 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
                <div class="space-y-8">
                    <span class="lux-badge-gold">Experiência prime para empresários</span>
                    <h1 class="font-poppins text-4xl font-semibold leading-tight text-white sm:text-5xl">
                        Cadastre imóveis em minutos, acompanhe métricas e acione concierge com brilho dourado
                    </h1>
                    <p class="max-w-2xl text-base text-white/70 sm:text-lg">
                        Estruture lançamentos, monitore performance em tempo real e utilize simuladores de ROI com suporte do concierge prime para fechar negócios com velocidade e sofisticação.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="lux-gold-button text-sm uppercase tracking-[0.25em]">
                            Criar conta empresarial
                        </a>
                        <a href="{{ auth()->check() ? route('businessman.dashboard') : route('login') }}" class="lux-outline-button text-sm uppercase tracking-[0.25em]">
                            Entrar no dashboard
                        </a>
                        <a href="{{ route('businessman.plans') }}" class="lux-outline-button text-sm uppercase tracking-[0.25em]">
                            Ver planos
                        </a>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Simulador</p>
                            <p class="mt-2 text-2xl font-semibold text-white">ROI dinâmico</p>
                            <p class="mt-1 text-sm text-white/60">Combine concierge, IA e campanhas para prever crescimento.</p>
                        </div>
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Concierge</p>
                            <p class="mt-2 text-2xl font-semibold text-white">On-demand</p>
                            <p class="mt-1 text-sm text-white/60">War rooms digitais, roteiros de visita e follow-ups automáticos.</p>
                        </div>
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Destaques</p>
                            <p class="mt-2 text-2xl font-semibold text-white">Glow dourado</p>
                            <p class="mt-1 text-sm text-white/60">Cards premium para atrair investidores com urgência.</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="lux-card-dark">
                        <div class="flex items-center justify-between border-b border-white/10 pb-6">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Simulador em ação</p>
                                <h3 class="mt-2 text-2xl font-semibold text-white">Cenários de receita</h3>
                            </div>
                            <span class="lux-badge-outline">Projeção IA</span>
                        </div>
                        <div class="mt-6 grid gap-4 sm:grid-cols-3">
                            <div class="lux-stat-bubble">
                                <span class="text-white/50">Ticket médio</span>
                                <span class="text-xl font-semibold text-white">R$ 2,4M</span>
                                <span class="text-white/40">Atualizado em tempo real</span>
                            </div>
                            <div class="lux-stat-bubble">
                                <span class="text-white/50">Conversão concierge</span>
                                <span class="text-xl font-semibold text-white">+27%</span>
                                <span class="text-white/40">Em 60 dias</span>
                            </div>
                            <div class="lux-stat-bubble">
                                <span class="text-white/50">Leads ativos</span>
                                <span class="text-xl font-semibold text-white">48</span>
                                <span class="text-white/40">Pipeline monitorado</span>
                            </div>
                        </div>
                    </div>
                    <div class="lux-card-dark">
                        <h3 class="text-xl font-semibold text-white">Orquestração completa</h3>
                        <div class="mt-6 space-y-4">
                            <div class="lux-property-card">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Status</p>
                                        <h4 class="mt-1 text-lg font-semibold text-white">Imóvel destacado</h4>
                                    </div>
                                    <span class="lux-property-status text-white/70">Concierge ativo</span>
                                </div>
                                <p class="text-sm text-white/60">Cards premium, landing dedicada e integração com concierge para visitantes VIP.</p>
                            </div>
                            <div class="lux-property-card">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Ação rápida</p>
                                        <h4 class="mt-1 text-lg font-semibold text-white">War room com investidores</h4>
                                    </div>
                                    <span class="lux-property-status text-white/70">Agendado</span>
                                </div>
                                <p class="text-sm text-white/60">Crie roteiros, receba alertas de follow-up e acompanhe o funil de negociação.</p>
                            </div>
                        </div>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('businessman.dashboard') }}" class="lux-gold-button text-xs uppercase tracking-[0.25em]">Abrir painel</a>
                            <a href="{{ route('businessman.plans') }}" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Comparar planos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('landing.partials.businessman')
@endsection
