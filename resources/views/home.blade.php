@extends('layouts.app')

@section('title', 'Prime Match Imo — Matchmaking Premium | Investimento Patrimonial de Luxo')

@section('content')
@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
@endphp

@include('components.prime-featured-section', [
    'featured' => $featured,
    'title' => 'Ativos Prime em Destaque',
    'subtitle' => 'Seleção exclusiva de oportunidades patrimoniais curadas pelo Concierge Master para investidores de alto padrão.',
])

{{-- Hero Section Premium --}}
<section class="lux-hero relative overflow-hidden">
    {{-- Background Gradient Premium --}}
    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 via-transparent to-blue-500/5"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-400/10 rounded-full blur-3xl"></div>
    
    <div class="lux-container py-20 lg:py-32 relative z-10">
        <div class="grid gap-16 lg:grid-cols-[1.1fr_0.9fr]">
            {{-- Left Column: Main Message --}}
            <div class="space-y-12">
                {{-- Premium Badge --}}
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full border border-yellow-400/30 bg-yellow-400/10 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                    <span class="text-xs uppercase tracking-[0.35em] text-yellow-300 font-semibold">Plataforma de Matchmaking Curado • Concierge Prime + IA</span>
                </div>

                {{-- Main Headline --}}
                <div class="space-y-8">
                    <h1 class="font-poppins text-5xl lg:text-6xl font-bold leading-tight text-white">
                        Ativos Patrimoniais de Luxo Conectados ao Investidor Ideal.
                    </h1>
                    <p class="max-w-2xl text-lg text-white/70 leading-relaxed">
                        A Prime Match Imo é a plataforma de matchmaking imobiliário premium que conecta investidores de alto padrão a oportunidades patrimoniais exclusivas. Com curadoria humana, análise de viabilidade financeira e um Concierge Prime dedicado, somos a ponte segura entre capital inteligente e ativos raros de retorno superior.
                    </p>
                </div>

                {{-- CTAs Premium --}}
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('investor.catalog') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em] px-8 py-4 font-semibold hover:shadow-[0_0_30px_rgba(245,158,11,0.4)] transition-all duration-300">
                        <i class="fas fa-chart-line mr-2"></i>Sou Investidor Prime
                    </a>
                    <a href="{{ route('landing.businessman') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em] px-8 py-4 font-semibold hover:border-yellow-400/50 transition-all duration-300">
                        <i class="fas fa-building mr-2"></i>Sou Empresário Prime
                    </a>
                    <a href="{{ ConciergeLink::build('investidor_card', [
                            'city' => 'Concierge Prime',
                            'type' => 'matchmaking premium',
                            'budget_min' => 5000000,
                            'budget_max' => 25000000,
                        ], [
                            'user_type' => 'investidor',
                            'source' => 'hero',
                        ]) }}"
                        target="_blank"
                        rel="noopener"
                        class="lux-outline-button text-xs uppercase tracking-[0.3em] px-8 py-4 font-semibold hover:border-yellow-400/50 transition-all duration-300">
                        <i class="fas fa-whatsapp mr-2"></i>Concierge 24/7 (WhatsApp)
                    </a>
                </div>

                {{-- Trust Indicators --}}
                <div class="grid gap-6 sm:grid-cols-3 pt-8 border-t border-white/10">
                    <div class="space-y-2">
                        <p class="text-3xl font-bold text-yellow-300">R$ 280M+</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">Tickets Ativos em Negociação</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-3xl font-bold text-yellow-300">+120</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">Ativos Curados e Validados</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-3xl font-bold text-yellow-300">18%</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">Taxa de Conversão Concierge</p>
                    </div>
                </div>
            </div>

            {{-- Right Column: Premium Panel --}}
            <div class="space-y-8 rounded-[24px] border border-yellow-400/20 bg-gradient-to-br from-yellow-400/10 to-transparent backdrop-blur-xl p-10 shadow-[0_20px_60px_rgba(245,158,11,0.1)]">
                <div class="space-y-4 border-b border-yellow-400/20 pb-8">
                    <div class="inline-block">
                        <span class="px-3 py-1 rounded-full bg-yellow-400/20 border border-yellow-400/40 text-xs uppercase tracking-[0.3em] text-yellow-300 font-semibold">Pipeline Premium</span>
                    </div>
                    <h3 class="text-3xl font-bold text-white">Oportunidades Monitoradas</h3>
                    <p class="text-sm text-white/60">Acompanhamento em tempo real com SLA de 5 minutos no WhatsApp</p>
                </div>

                {{-- KPI Cards --}}
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-[16px] border border-yellow-400/20 bg-yellow-400/5 p-6 backdrop-blur-sm hover:bg-yellow-400/10 transition-all duration-300">
                        <p class="text-xs uppercase tracking-[0.2em] text-yellow-300/70 font-semibold">Tempo de Resposta</p>
                        <p class="mt-4 text-4xl font-bold text-yellow-300">3h</p>
                        <p class="mt-2 text-xs text-white/60">Do briefing à pré-proposta</p>
                    </div>
                    <div class="rounded-[16px] border border-yellow-400/20 bg-yellow-400/5 p-6 backdrop-blur-sm hover:bg-yellow-400/10 transition-all duration-300">
                        <p class="text-xs uppercase tracking-[0.2em] text-yellow-300/70 font-semibold">Curadoria Rigorosa</p>
                        <p class="mt-4 text-4xl font-bold text-yellow-300">100%</p>
                        <p class="mt-2 text-xs text-white/60">Validação humana + IA</p>
                    </div>
                    <div class="rounded-[16px] border border-yellow-400/20 bg-yellow-400/5 p-6 backdrop-blur-sm hover:bg-yellow-400/10 transition-all duration-300">
                        <p class="text-xs uppercase tracking-[0.2em] text-yellow-300/70 font-semibold">Exclusividade</p>
                        <p class="mt-4 text-4xl font-bold text-yellow-300">Única</p>
                        <p class="mt-2 text-xs text-white/60">Sem duplicidade de anúncios</p>
                    </div>
                    <div class="rounded-[16px] border border-yellow-400/20 bg-yellow-400/5 p-6 backdrop-blur-sm hover:bg-yellow-400/10 transition-all duration-300">
                        <p class="text-xs uppercase tracking-[0.2em] text-yellow-300/70 font-semibold">Suporte Dedicado</p>
                        <p class="mt-4 text-4xl font-bold text-yellow-300">24/7</p>
                        <p class="mt-2 text-xs text-white/60">Concierge exclusivo</p>
                    </div>
                </div>

                {{-- Feature Highlights --}}
                <div class="space-y-3 border-t border-yellow-400/20 pt-8">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check text-yellow-300 mt-1"></i>
                        <div>
                            <p class="text-sm font-semibold text-white">Análise de Viabilidade Financeira</p>
                            <p class="text-xs text-white/60">Cap Rate, valorização e fluxo de caixa projetado</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check text-yellow-300 mt-1"></i>
                        <div>
                            <p class="text-sm font-semibold text-white">Data Room Completo</p>
                            <p class="text-xs text-white/60">Documentação, laudos e due diligence integrados</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check text-yellow-300 mt-1"></i>
                        <div>
                            <p class="text-sm font-semibold text-white">Intermediação Segura</p>
                            <p class="text-xs text-white/60">Negociação assistida até o fechamento</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Como Funciona Section --}}
<section class="lux-section relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/10 via-transparent to-blue-500/10 blur-3xl opacity-60"></div>
    <div class="lux-container relative z-10">
        <div class="flex flex-col gap-12 lg:flex-row lg:items-start">
            <div class="space-y-6 max-w-xl">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full border border-yellow-400/30 bg-yellow-400/10 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-yellow-300 animate-pulse"></span>
                    <span class="text-xs uppercase tracking-[0.3em] text-yellow-200 font-semibold">Como funciona</span>
                </div>
                <div class="space-y-4">
                    <h2 class="font-poppins text-5xl font-bold text-white leading-tight">Uma jornada premium, sem ruído.</h2>
                    <p class="text-lg text-white/70 leading-relaxed">Processo concierge com checkpoints claros, rituais de validação e acompanhamento ativo. Você vê o pipeline evoluir em tempo real.</p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-[16px] border border-white/10 bg-white/5 p-5 backdrop-blur-md">
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">Tempo médio de resposta</p>
                        <p class="text-3xl font-bold text-yellow-300 mt-2">&lt; 5 min</p>
                    </div>
                    <div class="rounded-[16px] border border-white/10 bg-white/5 p-5 backdrop-blur-md">
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">Curadoria com IA + humano</p>
                        <p class="text-3xl font-bold text-yellow-300 mt-2">100%</p>
                    </div>
                </div>
            </div>

            <div class="flex-1 grid gap-6">
                <div class="relative pl-10">
                    <div class="absolute left-3 top-2 bottom-2 w-px bg-gradient-to-b from-yellow-300/60 via-white/20 to-transparent"></div>
                    <div class="flex gap-4 items-start p-6 rounded-[18px] border border-white/10 bg-white/5 backdrop-blur-xl hover:border-yellow-300/40 transition-all duration-300">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 text-white font-bold">01</div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <h3 class="text-xl font-bold text-white">Briefing estratégico</h3>
                                <span class="px-3 py-1 rounded-full bg-yellow-400/20 text-xs text-yellow-200 border border-yellow-400/30">Perfil investidor</span>
                            </div>
                            <p class="text-sm text-white/70">Investidor ou empresário compartilha objetivo de retorno, ticket e localização prioritária. Concierge já monta o dossiê de busca.</p>
                        </div>
                    </div>
                </div>

                <div class="relative pl-10">
                    <div class="absolute left-3 top-2 bottom-2 w-px bg-gradient-to-b from-yellow-300/60 via-white/20 to-transparent"></div>
                    <div class="flex gap-4 items-start p-6 rounded-[18px] border border-white/10 bg-white/5 backdrop-blur-xl hover:border-yellow-300/40 transition-all duration-300">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 text-white font-bold">02</div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <h3 class="text-xl font-bold text-white">Curadoria &amp; Viabilidade</h3>
                                <span class="px-3 py-1 rounded-full bg-blue-500/20 text-xs text-blue-100 border border-blue-400/30">Data Room</span>
                            </div>
                            <p class="text-sm text-white/70">Pipeline enxuto com ativos validados: cap rate, upside, riscos e documentação em um card visual. Feedback pelo WhatsApp em tempo real.</p>
                        </div>
                    </div>
                </div>

                <div class="relative pl-10">
                    <div class="absolute left-3 top-2 bottom-2 w-px bg-gradient-to-b from-yellow-300/60 via-white/20 to-transparent"></div>
                    <div class="flex gap-4 items-start p-6 rounded-[18px] border border-white/10 bg-white/5 backdrop-blur-xl hover:border-yellow-300/40 transition-all duration-300">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 text-white font-bold">03</div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <h3 class="text-xl font-bold text-white">Negociação assistida</h3>
                                <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-xs text-emerald-100 border border-emerald-400/30">SLA concierge</span>
                            </div>
                            <p class="text-sm text-white/70">Visitas, proposta formal, estruturação societária e fechamento acompanhados pelo mesmo concierge. Tudo com segurança e agilidade.</p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-[18px] border border-yellow-400/30 bg-gradient-to-r from-yellow-500/10 to-transparent p-6 flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-yellow-200">Concierge Prime</p>
                            <p class="text-2xl font-semibold text-white mt-2">Canal direto no WhatsApp</p>
                        </div>
                        <i class="fas fa-whatsapp text-2xl text-yellow-300"></i>
                    </div>
                    <div class="rounded-[18px] border border-white/10 bg-white/5 p-6 backdrop-blur-xl">
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">Visão executiva</p>
                        <p class="text-sm text-white/70 mt-2">Cards com resumo financeiro, status e próximos passos — visual e objetivo, como um board de investimentos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Benefícios Prime Section --}}
<section class="lux-section relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/5 via-blue-500/10 to-transparent"></div>

    <div class="lux-container relative z-10 space-y-10">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full border border-yellow-400/30 bg-yellow-400/10 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-yellow-300"></span>
                    <span class="text-xs uppercase tracking-[0.3em] text-yellow-200 font-semibold">Vantagens competitivas</span>
                </div>
                <h2 class="text-5xl font-bold text-white">Escolha a plataforma mais prime do mercado.</h2>
                <p class="text-white/70 max-w-2xl">Um ecossistema de serviços premium, tecnologia proprietária e segurança jurídica para proteger seu capital e acelerar decisões.</p>
            </div>
            <div class="flex gap-3">
                <div class="rounded-[14px] border border-white/10 bg-white/5 px-4 py-3 text-right">
                    <p class="text-xs uppercase tracking-[0.2em] text-white/60">NPS Concierge</p>
                    <p class="text-3xl font-bold text-yellow-300">96</p>
                </div>
                <div class="rounded-[14px] border border-white/10 bg-white/5 px-4 py-3 text-right">
                    <p class="text-xs uppercase tracking-[0.2em] text-white/60">Tickets ativos</p>
                    <p class="text-3xl font-bold text-yellow-300">R$ 280M+</p>
                </div>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.05fr_0.95fr]">
            <div class="grid gap-6 md:grid-cols-2">
                <div class="group rounded-[22px] border border-yellow-400/25 bg-gradient-to-br from-yellow-400/15 via-white/5 to-transparent p-7 shadow-[0_20px_60px_rgba(245,158,11,0.08)] transition duration-300 hover:-translate-y-1 hover:border-yellow-300/50">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-12 w-12 rounded-full bg-yellow-400/25 flex items-center justify-center group-hover:bg-yellow-400/35 transition">
                            <i class="fas fa-shield-alt text-yellow-200 text-lg"></i>
                        </div>
                        <span class="text-xs uppercase tracking-[0.2em] text-yellow-100">Curadoria autoral</span>
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-2">Due diligence premium</h3>
                    <p class="text-white/70 text-sm">Auditoria financeira, laudos técnicos e compliance jurídico centralizados em um data room seguro.</p>
                </div>

                <div class="group rounded-[22px] border border-white/10 bg-white/5 p-7 backdrop-blur-xl transition duration-300 hover:-translate-y-1 hover:border-yellow-300/50">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-12 w-12 rounded-full bg-yellow-400/20 flex items-center justify-center group-hover:bg-yellow-400/30 transition">
                            <i class="fas fa-gem text-yellow-200 text-lg"></i>
                        </div>
                        <span class="text-xs uppercase tracking-[0.2em] text-yellow-100">Exclusividade prime</span>
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-2">Zero ruído, zero duplicidade</h3>
                    <p class="text-white/70 text-sm">Cada ativo é único. Sem anúncios replicados ou concorrência entre canais — só oportunidades blindadas.</p>
                </div>

                <div class="group rounded-[22px] border border-white/10 bg-white/5 p-7 backdrop-blur-xl transition duration-300 hover:-translate-y-1 hover:border-yellow-300/50">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-12 w-12 rounded-full bg-yellow-400/20 flex items-center justify-center group-hover:bg-yellow-400/30 transition">
                            <i class="fas fa-chart-line text-yellow-200 text-lg"></i>
                        </div>
                        <span class="text-xs uppercase tracking-[0.2em] text-yellow-100">Inteligência financeira</span>
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-2">Cap rate, upside e liquidez</h3>
                    <p class="text-white/70 text-sm">Painéis executivos com projeção de fluxo de caixa, cenários de valorização e riscos mapeados.</p>
                </div>

                <div class="group rounded-[22px] border border-white/10 bg-white/5 p-7 backdrop-blur-xl transition duration-300 hover:-translate-y-1 hover:border-yellow-300/50">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-12 w-12 rounded-full bg-yellow-400/20 flex items-center justify-center group-hover:bg-yellow-400/30 transition">
                            <i class="fas fa-headset text-yellow-200 text-lg"></i>
                        </div>
                        <span class="text-xs uppercase tracking-[0.2em] text-yellow-100">Concierge sempre on</span>
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-2">Suporte one-to-one</h3>
                    <p class="text-white/70 text-sm">Canal direto 24/7, com o mesmo especialista acompanhando briefing, visitas e assinatura.</p>
                </div>
            </div>

            <div class="rounded-[24px] border border-yellow-400/25 bg-gradient-to-b from-yellow-400/15 via-black/10 to-black/30 p-8 shadow-[0_25px_70px_rgba(245,158,11,0.12)] flex flex-col gap-6">
                <div class="flex items-center gap-3">
                    <div class="h-12 w-12 rounded-full bg-yellow-400/25 flex items-center justify-center">
                        <i class="fas fa-handshake text-yellow-200 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-yellow-100">Intermediação segura</p>
                        <h3 class="text-2xl font-semibold text-white">Deal room com governança</h3>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-[16px] border border-white/10 bg-black/20 p-5">
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">Documentos</p>
                        <p class="text-white font-semibold mt-2">Laudos, certidões e contratos em um fluxo único.</p>
                    </div>
                    <div class="rounded-[16px] border border-white/10 bg-black/20 p-5">
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">Governança</p>
                        <p class="text-white font-semibold mt-2">Checklist de compliance, riscos e aprovação em tempo real.</p>
                    </div>
                </div>

                <div class="rounded-[16px] border border-yellow-400/30 bg-gradient-to-r from-yellow-500/15 to-transparent p-6 flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-yellow-200">Estruturação avançada</p>
                        <p class="text-white font-semibold mt-2">SPV, SPE ou M&amp;A estruturados com apoio jurídico de ponta.</p>
                    </div>
                    <i class="fas fa-arrow-right text-yellow-300 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Final Section --}}
<section class="lux-section">
    <div class="lux-container">
        <div class="rounded-[24px] border border-yellow-400/30 bg-gradient-to-r from-yellow-400/10 to-blue-500/10 backdrop-blur-xl p-12 text-center space-y-8">
            <h2 class="text-4xl lg:text-5xl font-bold text-white">Pronto para Encontrar Seu Ativo Ideal?</h2>
            <p class="max-w-2xl mx-auto text-lg text-white/70">Conecte-se com nosso Concierge Prime e explore oportunidades patrimoniais exclusivas com análise financeira completa.</p>
            <div class="flex flex-wrap gap-4 justify-center pt-4">
                <a href="{{ route('investor.catalog') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em] px-8 py-4 font-semibold">
                    <i class="fas fa-arrow-right mr-2"></i>Explorar Ativos
                </a>
                <a href="{{ ConciergeLink::build('investidor_card', [
                        'city' => 'Concierge Prime',
                        'type' => 'matchmaking premium',
                        'budget_min' => 5000000,
                        'budget_max' => 25000000,
                    ], [
                        'user_type' => 'investidor',
                        'source' => 'cta_final',
                    ]) }}"
                    target="_blank"
                    rel="noopener"
                    class="lux-outline-button text-xs uppercase tracking-[0.3em] px-8 py-4 font-semibold">
                    <i class="fas fa-whatsapp mr-2"></i>Falar com Concierge
                </a>
            </div>
        </div>
    </div>
</section>

@endsection