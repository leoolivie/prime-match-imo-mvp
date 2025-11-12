@extends('layouts.app')

@section('title', 'Prime Match Imo - Plataforma imobiliária inteligente com concierge prime')

@section('content')
@php
    $heroSlides = [
        [
            'title' => 'Cobertura cinematográfica nos Jardins',
            'location' => 'São Paulo • Jardins',
            'price' => '12.800.000',
            'financial' => 'Cap rate 6,8% • Upside concierge +12%',
            'highlights' => ['Penthouse 620m²', '3 suítes masters', 'Rooftop skyline'],
        ],
        [
            'title' => 'AAA Corporate na Faria Lima',
            'location' => 'São Paulo • Vila Olímpia',
            'price' => '64.000.000',
            'financial' => 'Yield 11,2% • Vacância 0%',
            'highlights' => ['Torre corporativa completa', 'Match com 4 fundos ativos', 'Retrofit premium 2024'],
        ],
        [
            'title' => 'Retreat pé na areia - Praia do Forte',
            'location' => 'Bahia • Praia do Forte',
            'price' => '8.900.000',
            'financial' => 'ROI turístico projetado 17% a.a.',
            'highlights' => ['Portfolio hospitality', 'Concierge full-service', 'Tax shield + concierge'],
        ],
    ];
@endphp

    <section class="lux-hero">
        <div class="relative lux-container py-24">
            <div class="grid gap-16 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="space-y-10">
                    <span class="lux-badge-gold">Plataforma imobiliária inteligente</span>
                    <div class="space-y-6">
                        <h1 class="font-poppins text-4xl font-semibold leading-tight text-white sm:text-5xl">
                            Matchmaking imobiliário com curadoria prime e concierge 24/7
                        </h1>
                        <p class="max-w-2xl text-base text-white/70 sm:text-lg">
                            Conectamos investidores, empresários e concierge prime em um ecossistema omnichannel
                            que combina inteligência artificial, dados financeiros em tempo real e atendimento humano
                            para desbloquear negócios extraordinários.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="lux-gold-button text-sm uppercase tracking-[0.25em]">
                            Começar agora
                        </a>
                        <a href="{{ route('landing.investor') }}" class="lux-outline-button text-sm uppercase tracking-[0.25em]">
                            Landing investidor
                        </a>
                        <a href="{{ route('investor.search') }}" class="lux-outline-button text-sm uppercase tracking-[0.25em]">
                            Ativar busca prime
                        </a>
                        <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, quero ativar minha curadoria prime.') }}" target="_blank" rel="noopener" class="lux-outline-button text-sm uppercase tracking-[0.25em]">
                            Concierge imediato
                        </a>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Matching IA</p>
                            <p class="mt-3 text-2xl font-semibold text-white">98% de aderência</p>
                            <p class="mt-1 text-sm text-white/60">Perfis validados e recomendações hiperpersonalizadas.</p>
                        </div>
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Concierge</p>
                            <p class="mt-3 text-2xl font-semibold text-white">24/7 dedicado</p>
                            <p class="mt-1 text-sm text-white/60">Pipeline acompanhado em todos os canais.</p>
                        </div>
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Capital monitorado</p>
                            <p class="mt-3 text-2xl font-semibold text-white">R$ 180M+</p>
                            <p class="mt-1 text-sm text-white/60">Negócios orquestrados com governança prime.</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="lux-card-dark" x-data="{
                        active: 0,
                        slides: @js($heroSlides),
                        interval: null,
                        init() {
                            this.interval = setInterval(() => {
                                this.active = (this.active + 1) % this.slides.length;
                            }, 6500);
                        }
                    }">
                        <div class="flex items-center justify-between border-b border-white/10 pb-6">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Carrossel cinematográfico</p>
                                <h3 class="mt-2 text-2xl font-semibold text-white">Imóveis em destaque</h3>
                            </div>
                            <span class="lux-badge-gold">Concierge ready</span>
                        </div>
                        <div class="mt-8 space-y-8">
                            <template x-for="(slide, index) in slides" :key="index">
                                <div x-show="active === index" x-transition.opacity.duration.500ms class="space-y-6">
                                    <div>
                                        <p class="text-sm uppercase tracking-[0.3em] text-white/50" x-text="slide.location"></p>
                                        <h4 class="mt-2 text-2xl font-semibold text-white" x-text="slide.title"></h4>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        <template x-for="highlight in slide.highlights" :key="highlight">
                                            <span class="lux-badge-outline" x-text="highlight"></span>
                                        </template>
                                    </div>
                                    <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-5 sm:grid-cols-2">
                                        <div>
                                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</p>
                                            <p class="mt-1 text-xl font-semibold text-white" x-text="'R$ ' + slide.price"></p>
                                        </div>
                                        <div>
                                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Snapshot financeiro</p>
                                            <p class="mt-1 text-sm text-white/70" x-text="slide.financial"></p>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        <a href="{{ route('register') }}" class="lux-gold-button text-xs uppercase tracking-[0.25em]">Solicitar visita</a>
                                        <a href="{{ route('login') }}" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Baixar dossiê</a>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="mt-8 flex items-center justify-between border-t border-white/10 pt-6">
                            <div class="flex gap-2">
                                <template x-for="(slide, index) in slides" :key="'dot-' + index">
                                    <button type="button"
                                            class="h-2 w-8 rounded-full transition"
                                            :class="active === index ? 'bg-lux-gold shadow-[0_0_25px_rgba(255,215,0,0.4)]' : 'bg-white/10 hover:bg-white/30'"
                                            @click="active = index"></button>
                                </template>
                            </div>
                            <div class="flex gap-2">
                                <button type="button" class="lux-outline-button px-4 py-2" @click="active = (active + slides.length - 1) % slides.length">Anterior</button>
                                <button type="button" class="lux-outline-button px-4 py-2" @click="active = (active + 1) % slides.length">Próximo</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lux-section">
        <div class="lux-container">
            <div class="grid gap-10 lg:grid-cols-[1fr_1.1fr]">
                <div class="space-y-6">
                    <span class="lux-badge-outline">Resultados prime</span>
                    <h2 class="font-poppins text-4xl font-semibold text-white">Governança, concierge e IA trabalhando juntos</h2>
                    <p class="max-w-xl text-lg text-white/60">
                        Do briefing ao fechamento, integramos dados financeiros, diligência documental e uma equipe concierge premium para acelerar negociações com transparência e desempenho.
                    </p>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="lux-metric-card">
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Matches IA</p>
                            <p class="text-3xl font-semibold text-white">1.200+</p>
                            <p class="text-sm text-white/60">Alertas personalizados e recomendações calibradas diariamente.</p>
                        </div>
                        <div class="lux-metric-card">
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Concierge</p>
                            <p class="text-3xl font-semibold text-white">24 horas</p>
                            <p class="text-sm text-white/60">Equipe prime cuidando de agendamentos, diligência e follow-ups.</p>
                        </div>
                        <div class="lux-metric-card">
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">VGV monitorado</p>
                            <p class="text-3xl font-semibold text-white">R$ 180M+</p>
                            <p class="text-sm text-white/60">Pipeline com previsibilidade, governança e KPIs em tempo real.</p>
                        </div>
                    </div>
                </div>
                <div class="lux-card-graphite">
                    <div class="flex flex-wrap gap-3">
                        <span class="lux-badge-gold">Prime concierge</span>
                        <span class="lux-badge-outline">Omnichannel</span>
                    </div>
                    <div class="mt-8 grid gap-6 md:grid-cols-2">
                        <div class="space-y-3">
                            <h3 class="text-lg font-semibold text-white">Tecnologia + pessoas</h3>
                            <p class="text-sm text-white/60">Dashboards premium conectam IA, equipe concierge e parceiros estratégicos para um acompanhamento sem fricção.</p>
                        </div>
                        <div class="space-y-3">
                            <h3 class="text-lg font-semibold text-white">Dossiês instantâneos</h3>
                            <p class="text-sm text-white/60">Cada imóvel ganha ficha técnica, indicadores financeiros, jornada de diligência e histórico de interações.</p>
                        </div>
                        <div class="space-y-3">
                            <h3 class="text-lg font-semibold text-white">Integração concierge</h3>
                            <p class="text-sm text-white/60">WhatsApp, vídeo, telefone ou e-mail com roteamento automático e resumos prontos para acelerar a decisão.</p>
                        </div>
                        <div class="space-y-3">
                            <h3 class="text-lg font-semibold text-white">Comandos rápidos</h3>
                            <p class="text-sm text-white/60">Quick actions para investidores, empresários e corretores acionarem concierge e visitas instantaneamente.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('landing.partials.investor')

    @include('landing.partials.businessman')

    @include('landing.partials.master')

    <section id="concierge" class="lux-section">
        <div class="lux-container">
            <div class="space-y-12">
                <div class="space-y-4 text-center">
                    <span class="lux-badge-outline">Concierge e prova social</span>
                    <h2 class="font-poppins text-4xl font-semibold text-white">Momentos concierge que encantam</h2>
                    <p class="mx-auto max-w-3xl text-lg text-white/60">Integração direta com WhatsApp, telefone, vídeo ou e-mail. Cada ação gera resumo automático da oportunidade e registro no pipeline.</p>
                </div>
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lux-card-dark">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">Confiança</h3>
                            <span class="lux-badge-gold">NPS 98</span>
                        </div>
                        <p class="mt-4 text-sm text-white/60">Auditorias, trilhas de aprovação e selos de diligência com status dourado garantem segurança para investidores e empresários.</p>
                    </div>
                    <div class="lux-card-dark">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">Depoimentos</h3>
                            <span class="lux-badge-gold">Stories prime</span>
                        </div>
                        <p class="mt-4 text-sm text-white/60">"A Prime Match Imo conectou nosso family office a três oportunidades off-market com concierge impecável" – Aline F., São Paulo.</p>
                    </div>
                    <div class="lux-card-dark">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">Próximos lançamentos</h3>
                            <span class="lux-badge-gold">Coming soon</span>
                        </div>
                        <p class="mt-4 text-sm text-white/60">Residenciais boutique no litoral norte, complexos corporativos e propriedades rurais produtivas com dossiê prime.</p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-white/60">
                    <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, quero falar agora com o time prime.') }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">WhatsApp concierge</a>
                    <a href="mailto:concierge@primematchimo.com.br" class="lux-outline-button text-xs uppercase tracking-[0.3em]">E-mail dedicado</a>
                    <a href="tel:+5514996845854" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Telefone direto</a>
                </div>
            </div>
        </div>
    </section>

    <section class="lux-section">
        <div class="lux-container">
            <div class="space-y-10">
                <div class="space-y-4 text-center">
                    <span class="lux-badge-outline">Os 12 prime</span>
                    <h2 class="font-poppins text-4xl font-semibold text-white">Nossos pilares de excelência</h2>
                </div>
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach([
                        'Curadoria humanizada com IA assistida',
                        'Concierge omnichannel com SLA de 5 minutos',
                        'Dossiês completos com indicadores financeiros',
                        'Watchlist inteligente com alertas personalizados',
                        'Simuladores de ROI com cenários dinâmicos',
                        'Integração com consultoria jurídica e fiscal',
                        'Planos flexíveis com glow dourado',
                        'Dashboards premium com trilhas de auditoria',
                        'Prova social e métricas de confiança em tempo real',
                        'Visitas presenciais e virtuais com concierge',
                        'Orquestração master com permissões avançadas',
                        'Comunicação automatizada com resumo das oportunidades',
                    ] as $pillar)
                        <div class="lux-card-surface flex items-start gap-4">
                            <span class="mt-1 flex h-8 w-8 items-center justify-center rounded-full border border-lux-gold/50 bg-lux-gold/10 text-sm font-semibold text-lux-gold">★</span>
                            <p class="text-sm text-white/70">{{ $pillar }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="lux-section">
        <div class="lux-container">
            <div class="grid gap-12 lg:grid-cols-[1fr_1.1fr]">
                <div class="space-y-6">
                    <span class="lux-badge-outline">Jornada prime</span>
                    <h2 class="font-poppins text-4xl font-semibold text-white">Quatro etapas para um match memorável</h2>
                    <p class="text-white/60">Do briefing ao pós-venda, cada etapa é acompanhada por concierge, IA e especialistas para garantir velocidade, governança e brilho dourado em cada interação.</p>
                </div>
                <div class="grid gap-4">
                    @foreach([
                        ['index' => '01', 'title' => 'Briefing inteligente', 'desc' => 'Coletamos objetivos de investimento ou portfólio com validação de dados e compliance.'],
                        ['index' => '02', 'title' => 'Curadoria assistida', 'desc' => 'Equipe prime prepara dossiês com análises financeiras, insights e cronogramas.'],
                        ['index' => '03', 'title' => 'Match & negociação', 'desc' => 'Negociação acompanhada com concierge omnichannel, visitas e war room digital.'],
                        ['index' => '04', 'title' => 'Fechamento prime', 'desc' => 'Suporte jurídico, financeiro e concierge pós-fechamento com métricas contínuas.'],
                    ] as $step)
                        <div class="lux-card-dark flex items-center gap-6">
                            <div class="flex h-14 w-14 items-center justify-center rounded-full border border-lux-gold/60 bg-lux-gold/15 text-lg font-semibold text-lux-gold">{{ $step['index'] }}</div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">{{ $step['title'] }}</h3>
                                <p class="mt-1 text-sm text-white/60">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
