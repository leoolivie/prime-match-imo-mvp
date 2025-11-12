@extends('layouts.app')

@section('title', 'Investidores - Prime Match Imo')

@section('content')
    <section class="lux-hero">
        <div class="lux-container py-20">
            <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div class="space-y-8">
                    <span class="lux-badge-gold">Experiência prime para investidores</span>
                    <h1 class="font-poppins text-4xl font-semibold leading-tight text-white sm:text-5xl">
                        Portfólios cinematográficos, métricas em tempo real e concierge dedicado 24/7
                    </h1>
                    <p class="max-w-2xl text-base text-white/70 sm:text-lg">
                        Explore ativos curados com indicadores financeiros completos, acompanhe negociações em tempo real e acione
                        o concierge prime em um clique para visitas, dossiês e war rooms digitais.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="lux-gold-button text-sm uppercase tracking-[0.25em]">
                            Criar conta investidor
                        </a>
                        <a href="{{ auth()->check() ? route('investor.dashboard') : route('login') }}" class="lux-outline-button text-sm uppercase tracking-[0.25em]">
                            Acessar dashboard
                        </a>
                        <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, quero conversar sobre oportunidades prime de investimento.') }}" target="_blank" rel="noopener" class="lux-outline-button text-sm uppercase tracking-[0.25em]">
                            Concierge imediato
                        </a>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Match IA</p>
                            <p class="mt-2 text-2xl font-semibold text-white">98% aderência</p>
                            <p class="mt-1 text-sm text-white/60">Perfis validados e recomendações inteligentes para cada objetivo.</p>
                        </div>
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">War rooms</p>
                            <p class="mt-2 text-2xl font-semibold text-white">Negociação guiada</p>
                            <p class="mt-1 text-sm text-white/60">Visitas, propostas e dossiês acompanhados pelo concierge prime.</p>
                        </div>
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Governança</p>
                            <p class="mt-2 text-2xl font-semibold text-white">Due diligence 92%</p>
                            <p class="mt-1 text-sm text-white/60">Auditorias, status de diligência e documentos sempre atualizados.</p>
                        </div>
                    </div>
                </div>
                <div class="lux-card-dark space-y-6">
                    <div class="flex items-center justify-between border-b border-white/10 pb-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Snapshot financeiro</p>
                            <h3 class="mt-2 text-2xl font-semibold text-white">Watchlist inteligente</h3>
                        </div>
                        <span class="lux-badge-outline">Live data</span>
                    </div>
                    <div class="space-y-4">
                        <div class="lux-property-card">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">São Paulo • Jardins</p>
                                    <h4 class="mt-1 text-lg font-semibold text-white">Cobertura cinematográfica com concierge</h4>
                                </div>
                                <span class="lux-property-status text-white/70">Yield 11,8%</span>
                            </div>
                            <p class="text-sm text-white/60">Asset residencial com programa de hospitalidade premium, concierge dedicado e cenário de valorização projetada.</p>
                            <div class="mt-4 grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-3">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</p>
                                    <p class="mt-1 text-lg font-semibold text-white">R$ 12.800.000</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Upside</p>
                                    <p class="mt-1 text-lg font-semibold text-white">+12% concierge</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Visita</p>
                                    <p class="mt-1 text-lg font-semibold text-white">Disponível 48h</p>
                                </div>
                            </div>
                        </div>
                        <div class="lux-property-card">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Florianópolis • Corporate</p>
                                    <h4 class="mt-1 text-lg font-semibold text-white">Campus tech triple net</h4>
                                </div>
                                <span class="lux-property-status text-white/70">Cap rate 9,2%</span>
                            </div>
                            <p class="text-sm text-white/60">Contrato de 12 anos, expansão planejada e concierge para conduzir due diligence e reuniões com stakeholders.</p>
                            <div class="mt-4 grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-3">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Ticket</p>
                                    <p class="mt-1 text-lg font-semibold text-white">R$ 42.000.000</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Vacância</p>
                                    <p class="mt-1 text-lg font-semibold text-white">0%</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">War room</p>
                                    <p class="mt-1 text-lg font-semibold text-white">Ativo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('investor.search') }}" class="lux-gold-button text-xs uppercase tracking-[0.25em]">Ativar busca prime</a>
                        <a href="{{ route('login') }}" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Salvar dossiês</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('landing.partials.investor')
@endsection
