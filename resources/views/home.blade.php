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
                    <span class="text-xs uppercase tracking-[0.35em] text-yellow-300 font-semibold">
                        Plataforma Prime de Matchmaking Imobiliário • IA Estratégica + Concierge Dedicado
                    </span>
                </div>

                {{-- Main Headline --}}
                <div class="space-y-8">
                    <h1 class="font-poppins text-5xl lg:text-6xl font-bold leading-tight text-white">
                        Ativos patrimoniais de luxo conectados sob medida ao investidor ideal.
                    </h1>
                    <p class="max-w-2xl text-lg text-white/70 leading-relaxed">
                        A Prime Match Imo é uma plataforma de matchmaking imobiliário premium que conecta investidores de alto padrão a ativos patrimoniais raros e exclusivos. Com curadoria humana aliada à inteligência de dados, análise profunda de viabilidade financeira e um Concierge Prime dedicado, somos a ponte segura entre capital inteligente e oportunidades singulares de alto potencial de retorno.
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
                        <i class="fas fa-whatsapp mr-2"></i>Concierge Prime 24/7 (WhatsApp Exclusivo)
                    </a>
                </div>

                {{-- Trust Indicators --}}
                <div class="grid gap-6 sm:grid-cols-3 pt-8 border-t border-white/10">
                    <div class="space-y-2">
                        <p class="text-3xl font-bold text-yellow-300">R$ 280M+</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">em tickets prime atualmente em negociação</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-3xl font-bold text-yellow-300">+120</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">ativos prime curados, validados e em acompanhamento</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-3xl font-bold text-yellow-300">18%</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-white/60">taxa de conversão em operações com Concierge Prime</p>
                    </div>
                </div>
            </div>

            {{-- Right Column: Premium Panel --}}
            <div class="space-y-8 rounded-[24px] border border-yellow-400/20 bg-gradient-to-br from-yellow-400/10 to-transparent backdrop-blur-xl p-10 shadow-[0_20px_60px_rgba(245,158,11,0.1)]">
                <div class="space-y-4 border-b border-yellow-400/20 pb-8">
                    <div class="inline-block">
                        <span class="px-3 py-1 rounded-full bg-yellow-400/20 border border-yellow-400/40 text-xs uppercase tracking-[0.3em] text-yellow-300 font-semibold">
                            Pipeline Prime de Oportunidades
                        </span>
                    </div>
                    <h3 class="text-3xl font-bold text-white">Oportunidades Monitoradas</h3>
                    <p class="text-sm text-white/60">
                        Oportunidades acompanhadas em tempo real, com SLA médio de resposta de até 5 minutos no WhatsApp.
                    </p>
                </div>

                {{-- KPI Cards --}}
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-[16px] border border-yellow-400/20 bg-yellow-400/5 p-6 backdrop-blur-sm hover:bg-yellow-400/10 transition-all duration-300">
                        <p class="text-xs uppercase tracking-[0.2em] text-yellow-300/70 font-semibold">Tempo de Resposta Prime</p>
                        <p class="mt-4 text-4xl font-bold text-yellow-300">3h</p>
                        <p class="mt-2 text-xs text-white/60">do briefing qualificado à apresentação da primeira pré-proposta</p>
                    </div>
                    <div class="rounded-[16px] border border-yellow-400/20 bg-yellow-400/5 p-6 backdrop-blur-sm hover:bg-yellow-400/10 transition-all duration-300">
                        <p class="text-xs uppercase tracking-[0.2em] text-yellow-300/70 font-semibold">Curadoria Rigorosa Prime</p>
                        <p class="mt-4 text-4xl font-bold text-yellow-300">100%</p>
                        <p class="mt-2 text-xs text-white/60">dos ativos passam por validação humana + IA proprietária</p>
                    </div>
                    <div class="rounded-[16px] border border-yellow-400/20 bg-yellow-400/5 p-6 backdrop-blur-sm hover:bg-yellow-400/10 transition-all duration-300">
                        <p class="text-xs uppercase tracking-[0.2em] text-yellow-300/70 font-semibold">Exclusividade Patrimonial</p>
                        <p class="mt-4 text-4xl font-bold text-yellow-300">Única</p>
                        <p class="mt-2 text-xs text-white/60">sem duplicidade de anúncios e com controle rígido de exposição</p>
                    </div>
                    <div class="rounded-[16px] border border-yellow-400/20 bg-yellow-400/5 p-6 backdrop-blur-sm hover:bg-yellow-400/10 transition-all duration-300">
                        <p class="text-xs uppercase tracking-[0.2em] text-yellow-300/70 font-semibold">Suporte Dedicado Prime</p>
                        <p class="mt-4 text-4xl font-bold text-yellow-300">24/7</p>
                        <p class="mt-2 text-xs text-white/60">concierge exclusivo acompanhando toda a jornada</p>
                    </div>
                </div>

                {{-- Feature Highlights --}}
                <div class="space-y-3 border-t border-yellow-400/20 pt-8">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check text-yellow-300 mt-1"></i>
                        <div>
                            <p class="text-sm font-semibold text-white">Análise de Viabilidade Financeira Prime</p>
                            <p class="text-xs text-white/60">Cap Rate, potencial de valorização e fluxo de caixa projetado com visão patrimonial de longo prazo.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check text-yellow-300 mt-1"></i>
                        <div>
                            <p class="text-sm font-semibold text-white">Data Room Prime Completo</p>
                            <p class="text-xs text-white/60">Documentação, laudos, pareceres e due diligence integrados em um ambiente seguro.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check text-yellow-300 mt-1"></i>
                        <div>
                            <p class="text-sm font-semibold text-white">Intermediação Segura e Discreta</p>
                            <p class="text-xs text-white/60">Negociação assistida, estruturada e acompanhada até o fechamento da operação.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Como Funciona Section --}}
<section class="lux-section">
    <div class="lux-container">
        <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="space-y-6">
                <div class="inline-block">
                    <span class="px-3 py-1 rounded-full bg-yellow-400/20 border border-yellow-400/40 text-xs uppercase tracking-[0.3em] text-yellow-300 font-semibold">
                        Como Funciona
                    </span>
                </div>
                <h2 class="font-poppins text-5xl font-bold text-white leading-tight">
                    Três passos para chegar ao seu ativo patrimonial ideal
                </h2>
                <p class="text-lg text-white/60 leading-relaxed">
                    Intermediação curada de ponta a ponta: o Concierge Prime recebe seu briefing, valida seu perfil patrimonial e acompanha cada movimento com transparência e sofisticação na condução da negociação.
                </p>
            </div>
            <div class="space-y-6">
                {{-- Step 1 --}}
                <div class="flex gap-6 p-6 rounded-[16px] border border-white/10 bg-white/5 hover:bg-white/10 transition-all duration-300">
                    <div class="flex-shrink-0">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 text-white font-bold text-xl">01</div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Cadastre ou Explore Ativos Prime</h3>
                        <p class="text-sm text-white/60 mt-2">
                            Empresários cadastram ativos exclusivos já com análise financeira estruturada. Investidores exploram oportunidades alinhadas ao seu perfil de risco, horizonte de tempo e objetivo de retorno.
                        </p>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="flex gap-6 p-6 rounded-[16px] border border-white/10 bg-white/5 hover:bg-white/10 transition-all duration-300">
                    <div class="flex-shrink-0">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 text-white font-bold text-xl">02</div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Concierge Filtra, Refina e Valida</h3>
                        <p class="text-sm text-white/60 mt-2">
                            Você fala diretamente com o Concierge Prime no WhatsApp. Ele aprofunda seu perfil de risco, interpreta seus objetivos e seleciona apenas os ativos com melhor viabilidade financeira e aderência ao seu momento.
                        </p>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="flex gap-6 p-6 rounded-[16px] border border-white/10 bg-white/5 hover:bg-white/10 transition-all duration-300">
                    <div class="flex-shrink-0">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 text-white font-bold text-xl">03</div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Intermediação Prime até o Fechamento</h3>
                        <p class="text-sm text-white/60 mt-2">
                            Organizamos visitas privativas, dossiê completo, proposta formal estruturada e negociação assistida. Sempre com segurança jurídica, discrição absoluta e agilidade compatível com o padrão do seu patrimônio.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Benefícios Prime Section --}}
<section class="lux-section relative overflow-hidden">
    {{-- Background Accent --}}
    <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/5 via-transparent to-transparent"></div>
    
    <div class="lux-container relative z-10">
        <div class="space-y-12">
            <div class="space-y-4">
                <div class="inline-block">
                    <span class="px-3 py-1 rounded-full bg-yellow-400/20 border border-yellow-400/40 text-xs uppercase tracking-[0.3em] text-yellow-300 font-semibold">
                        Vantagens Competitivas Prime
                    </span>
                </div>
                <h2 class="text-5xl font-bold text-white">
                    Por que investidores e empresários escolhem a Prime Match Imo
                </h2>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                {{-- Benefit 1 --}}
                <div class="group rounded-[20px] border border-yellow-400/20 bg-gradient-to-br from-yellow-400/10 to-transparent p-8 hover:border-yellow-400/40 hover:bg-yellow-400/15 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full bg-yellow-400/20 flex items-center justify-center mb-6 group-hover:bg-yellow-400/30 transition-all duration-300">
                        <i class="fas fa-shield-alt text-yellow-300 text-lg"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Curadoria Premium de Ativos Patrimoniais</h3>
                    <p class="text-white/70 leading-relaxed">
                        Seleção rigorosa de ativos com análise combinada humana + IA. Cada imóvel passa por validação financeira, checagem documental e avaliação de risco antes de entrar para o radar Prime.
                    </p>
                </div>

                {{-- Benefit 2 --}}
                <div class="group rounded-[20px] border border-yellow-400/20 bg-gradient-to-br from-yellow-400/10 to-transparent p-8 hover:border-yellow-400/40 hover:bg-yellow-400/15 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full bg-yellow-400/20 flex items-center justify-center mb-6 group-hover:bg-yellow-400/30 transition-all duration-300">
                        <i class="fas fa-gem text-yellow-300 text-lg"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Exclusividade Garantida de Exposição</h3>
                    <p class="text-white/70 leading-relaxed">
                        Ativos únicos dentro da plataforma, sem duplicidade de anúncios e sem pulverização em múltiplos canais. Oportunidades verdadeiramente exclusivas, com controle de acesso e de informação.
                    </p>
                </div>

                {{-- Benefit 3 --}}
                <div class="group rounded-[20px] border border-yellow-400/20 bg-gradient-to-br from-yellow-400/10 to-transparent p-8 hover:border-yellow-400/40 hover:bg-yellow-400/15 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full bg-yellow-400/20 flex items-center justify-center mb-6 group-hover:bg-yellow-400/30 transition-all duration-300">
                        <i class="fas fa-headset text-yellow-300 text-lg"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Concierge Prime 24/7</h3>
                    <p class="text-white/70 leading-relaxed">
                        Um único concierge dedicado conduz toda a sua jornada pelo WhatsApp. Suporte premium, resposta ágil e acompanhamento personalizado em cada etapa da decisão.
                    </p>
                </div>

                {{-- Benefit 4 --}}
                <div class="group rounded-[20px] border border-yellow-400/20 bg-gradient-to-br from-yellow-400/10 to-transparent p-8 hover:border-yellow-400/40 hover:bg-yellow-400/15 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full bg-yellow-400/20 flex items-center justify-center mb-6 group-hover:bg-yellow-400/30 transition-all duration-300">
                        <i class="fas fa-chart-line text-yellow-300 text-lg"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Análise Financeira Completa e Transparente</h3>
                    <p class="text-white/70 leading-relaxed">
                        Cap Rate estimado, potencial de valorização, custos operacionais, riscos envolvidos e projeção de fluxo de caixa. Decisões embasadas em dados, sem ruído e com visão patrimonial de longo prazo.
                    </p>
                </div>

                {{-- Benefit 5 --}}
                <div class="group rounded-[20px] border border-yellow-400/20 bg-gradient-to-br from-yellow-400/10 to-transparent p-8 hover:border-yellow-400/40 hover:bg-yellow-400/15 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full bg-yellow-400/20 flex items-center justify-center mb-6 group-hover:bg-yellow-400/30 transition-all duration-300">
                        <i class="fas fa-lock text-yellow-300 text-lg"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Data Room Prime Seguro</h3>
                    <p class="text-white/70 leading-relaxed">
                        Acesso centralizado à documentação completa, laudos de avaliação, contratos e due diligence. Transparência total com camadas reforçadas de segurança e controle de acesso.
                    </p>
                </div>

                {{-- Benefit 6 --}}
                <div class="group rounded-[20px] border border-yellow-400/20 bg-gradient-to-br from-yellow-400/10 to-transparent p-8 hover:border-yellow-400/40 hover:bg-yellow-400/15 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full bg-yellow-400/20 flex items-center justify-center mb-6 group-hover:bg-yellow-400/30 transition-all duration-300">
                        <i class="fas fa-handshake text-yellow-300 text-lg"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Intermediação Segura e Estruturada</h3>
                    <p class="text-white/70 leading-relaxed">
                        Negociação assistida, proposta formal acompanhada, alinhamento entre as partes e suporte contínuo até o fechamento. Segurança patrimonial em cada etapa da jornada.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Final Section --}}
<section class="lux-section">
    <div class="lux-container">
        <div class="rounded-[24px] border border-yellow-400/30 bg-gradient-to-r from-yellow-400/10 to-blue-500/10 backdrop-blur-xl p-12 text-center space-y-8">
            <h2 class="text-4xl lg:text-5xl font-bold text-white">Pronto para Encontrar Seu Ativo Patrimonial Ideal?</h2>
            <p class="max-w-2xl mx-auto text-lg text-white/70">
                Conecte-se com o nosso Concierge Prime e explore, com total confidencialidade, oportunidades patrimoniais exclusivas acompanhadas de análise financeira completa e visão estratégica de longo prazo.
            </p>
            <div class="flex flex-wrap gap-4 justify-center pt-4">
                <a href="{{ route('investor.catalog') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em] px-8 py-4 font-semibold">
                    <i class="fas fa-arrow-right mr-2"></i>Explorar Ativos Prime
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
                    <i class="fas fa-whatsapp mr-2"></i>Falar com o Concierge Prime
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
