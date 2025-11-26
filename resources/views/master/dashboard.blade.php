@extends('layouts.app')

@section('title', 'Painel de Gestão de Ativos e Performance')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-12">
        <header class="lux-card-dark space-y-10">
            <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-start">
                <div class="space-y-5">
                    <span class="lux-badge-gold">Painel de Gestão de Ativos</span>
                    <div class="space-y-4">
                        {{-- Título focado em Gestão e Performance --}}
                        <h1 class="font-poppins text-4xl font-semibold text-white">Orquestração de Performance e Carteira de Investidores</h1>
                        <p class="max-w-2xl text-white/70">Acompanhe a performance dos ativos, o engajamento dos investidores e os principais KPIs de retorno em um painel executivo e estratégico.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('master.users') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Gerenciar Investidores</a>
                        <a href="{{ route('master.properties') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Gerenciar Ativos</a>
                        <a href="{{ route('master.partners') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Parceiros Estratégicos</a>
                        <a href="{{ route('master.featured-properties.index') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ativos em Destaque</a>
                        <a href="{{ route('master.opportunities.edit') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Oportunidades de Investimento</a>
                        <a href="{{ route('master.dashboard.export') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Exportar Relatório Executivo</a>
                    </div>
                </div>
                {{-- Stats Otimizados para Investidores/Gestão --}}
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-2">
                    <div class="lux-stat-bubble">
                        <span class="text-white/60 uppercase tracking-[0.2em]">Valor Total de Ativos</span>
                        <span class="text-3xl font-semibold text-white">{{ $stats['formatted_asset_value'] ?? 'R$ 0,00' }}</span>
                        <span class="text-white/40 text-sm">Em carteira</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60 uppercase tracking-[0.2em]">Cap Rate Médio</span>
                        <span class="text-3xl font-semibold text-white">{{ $stats['formatted_avg_cap_rate'] ?? '0,00%' }}</span>
                        <span class="text-white/40 text-sm">Projeção de Renda e liquidez</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60 uppercase tracking-[0.2em]">Investidores Ativos</span>
                        <span class="text-3xl font-semibold text-white">{{ number_format($stats['active_investors'] ?? 0) }}</span>
                        <span class="text-white/40 text-sm">Com perfil validado</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60 uppercase tracking-[0.2em]">Conversão (30d)</span>
                        <span class="text-3xl font-semibold text-white">{{ $stats['formatted_investor_conversion_rate'] ?? '0,00%' }}</span>
                        <span class="text-white/40 text-sm">Leads qualificados para Data Room</span>
                    </div>
                </div>
            </div>
        </header>

        <section class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="lux-card-dark space-y-6">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h2 class="text-2xl font-semibold text-white">Atalhos Estratégicos</h2>
                        <p class="text-sm text-white/60">Performance · Viabilidade · Relatórios · Segmentação</p>
                    </div>
                    <div class="flex flex-wrap gap-2 text-xs uppercase tracking-[0.3em] text-white/60">
                        <a class="lux-tab lux-tab-active" href="{{ route('master.properties') }}">Performance</a>
                        <a class="lux-tab" href="{{ route('master.opportunities.edit') }}">Viabilidade</a>
                        <a class="lux-tab" href="{{ route('master.dashboard.export') }}">Relatórios</a>
                        <a class="lux-tab" href="{{ route('master.users') }}">Segmentação</a>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="lux-card-gold">
                        <h3 class="text-lg font-semibold text-white">Radar de Performance de Ativos</h3>
                        <p class="mt-2 text-sm text-white/70">KPIs de Cap Rate, ROI e Liquidez em tempo real com alertas de oportunidade.</p>
                        <dl class="mt-3 space-y-1 text-sm text-white/80">
                            <div class="flex justify-between"><dt>Ativos ativos</dt><dd>{{ $stats['active_properties'] }}</dd></div>
                            <div class="flex justify-between"><dt>Ticket médio</dt><dd>{{ $stats['formatted_avg_ticket'] }}</dd></div>
                            <div class="flex justify-between"><dt>Visitas (30d)</dt><dd>{{ number_format($stats['visits_30']) }}</dd></div>
                        </dl>
                        <a href="{{ route('master.properties') }}" class="mt-3 inline-flex text-xs uppercase tracking-[0.3em] text-yellow-200">Abrir carteira</a>
                    </div>
                    <div class="lux-card-gold">
                        <h3 class="text-lg font-semibold text-white">Gerar Relatórios de Viabilidade</h3>
                        <p class="mt-2 text-sm text-white/70">Exportação de análise de *due diligence* e projeção de fluxo de caixa.</p>
                        <p class="mt-2 text-xs text-white/60">Última atualização de métricas em tempo real de visitas, conversão e leads qualificados.</p>
                        <a href="{{ route('master.dashboard.export') }}" class="mt-3 inline-flex text-xs uppercase tracking-[0.3em] text-yellow-200">Exportar CSV executivo</a>
                    </div>
                    <div class="lux-card-gold">
                        <h3 class="text-lg font-semibold text-white">Ajustes de Modelo de Negócio</h3>
                        <p class="mt-2 text-sm text-white/70">Controle a precificação, parâmetros de Cap Rate e permissões de acesso ao Data Room.</p>
                        <p class="mt-2 text-xs text-white/60">Cap Rate médio estimado: <span class="font-semibold text-yellow-200">{{ $stats['formatted_avg_cap_rate'] }}</span></p>
                        <a href="{{ route('master.partners') }}" class="mt-3 inline-flex text-xs uppercase tracking-[0.3em] text-yellow-200">Estruturar parceiros</a>
                    </div>
                    <div class="lux-card-gold">
                        <h3 class="text-lg font-semibold text-white">Segmentação de Investidores</h3>
                        <p class="mt-2 text-sm text-white/70">Filtre investidores por perfil de risco, budget e histórico de aquisição.</p>
                        <p class="mt-2 text-xs text-white/60">Base ativa: {{ number_format($stats['investors']) }} investidores · Leads (30d): {{ number_format($stats['lead_volume_30']) }}</p>
                        <a href="{{ route('master.users') }}" class="mt-3 inline-flex text-xs uppercase tracking-[0.3em] text-yellow-200">Abrir segmentação</a>
                    </div>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-6 text-sm text-white/70">
                    <p class="font-semibold text-white">Modo “Ver como” para Auditoria</p>
                    <p class="text-xs text-white/50">Acesse a jornada de Master, Investidor e Consultor Patrimonial para garantir a integridade da informação e a experiência do usuário.</p>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <button class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver como Master</button>
                        <button class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver como Investidor</button>
                        <button class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver como Consultor</button>
                        <button class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver como Parceiro</button>
                    </div>
                </div>
            </div>

            <div class="lux-card-dark space-y-6">
                <h2 class="text-xl font-semibold text-white">Ativos Recentes Adicionados</h2>
                <div class="mt-6 space-y-4">
                    @forelse($recentProperties as $property)
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <p class="text-base font-semibold text-white">{{ $property->title }}</p>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Ativo em {{ $property->city }} • {{ $property->state }}</p>
                                    <p class="text-xs text-white/50">Proprietário: {{ $property->owner->name }}</p>
                                </div>
                                <span class="lux-property-status text-white/70">{{ ucfirst($property->status) }}</span>
                            </div>
                            <p class="mt-3 text-sm text-white/60">Valor de Mercado: R$ {{ number_format($property->price, 2, ',', '.') }}</p>
                            {{-- Assumindo que Cap Rate e Valorização estão disponíveis no objeto $property --}}
                            <p class="mt-1 text-sm text-yellow-300 font-semibold">Cap Rate Est.: {{ $property->cap_rate ?? 'N/A' }}% | Valorização Proj.: {{ $property->valorization_potential ?? 'N/A' }}%</p>
                        </div>
                    @empty
                        <p class="text-sm text-white/60">Nenhum ativo cadastrado recentemente.</p>
                    @endforelse
                </div>
                <div class="space-y-4 rounded-3xl border border-white/10 bg-white/5 p-6 text-sm text-white/70">
                    <h3 class="text-lg font-semibold text-white">Monitoramento de Oportunidades</h3>
                    <p>Atualize KPIs e alertas de Cap Rate a cada minuto para identificar oportunidades de investimento quentes.</p>
                    <div class="flex flex-wrap gap-3">
                        <span class="lux-badge-gold">Monitorar ROI</span>
                        <span class="lux-badge-outline">Trackear Cap Rate</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection