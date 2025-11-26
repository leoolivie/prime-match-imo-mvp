@extends('layouts.app')

@section('title', 'Prime Match Imo para EmpresÃ¡rios')

@push('head')
    <meta name="description" content="Prime Match Imo conecta empresÃ¡rios do mercado imobiliÃ¡rio de alto padrÃ£o a investidores qualificados, com destaque opcional e success-fee de 1%." />
    <meta property="og:title" content="Prime Match Imo Â· Plataforma Exclusiva para EmpresÃ¡rios" />
    <meta property="og:description" content="Cadastre ate 500 imoveis sem custo, destaque opcional e success-fee de 1% com base de investidores qualificados." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
@endpush

@php
    $whatsappBase = 'https://wa.me/5514996845854?text=';
    $heroMessage = 'OlÃ¡! Quero saber mais sobre a Prime Match Imo para empresÃ¡rios.';
    $demoMessage = 'OlÃ¡! Quero agendar uma demonstraÃ§Ã£o da Prime Match Imo.';
    $highlightMessage = 'OlÃ¡! Quero colocar meu imÃ³vel em destaque na Prime Match Imo.';
    $generalMessage = 'OlÃ¡! Tenho interesse em utilizar a plataforma como empresÃ¡rio.';
    $heroUrl = $whatsappBase . rawurlencode($heroMessage);
    $demoUrl = $whatsappBase . rawurlencode($demoMessage);
    $highlightUrl = $whatsappBase . rawurlencode($highlightMessage);
    $generalUrl = $whatsappBase . rawurlencode($generalMessage);
@endphp

@section('content')
    <span class="sr-only">ExperiÃªncia prime para empresÃ¡rios</span>
    <header class="lux-hero">
        <div class="lux-container relative py-24 pb-40 sm:py-28 sm:pb-36 lg:pb-28">
            <div class="grid gap-16 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                <div class="space-y-8">
                    <div class="flex flex-wrap items-center gap-4">
                        <span class="lux-badge-gold">ApresentaÃ§Ã£o exclusiva</span>
                        <span class="inline-flex items-center rounded-full border border-white/15 bg-white/5 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.3em] text-white/70">
                            EmpresÃ¡rio Prime
                        </span>
                    </div>
                    <h1 class="max-w-2xl font-poppins text-4xl font-semibold leading-tight text-white sm:text-5xl">
                        ApresentaÃ§Ã£o de Plataforma Exclusiva para EmpresÃ¡rios
                    </h1>
                    <p class="max-w-2xl text-base text-white/70 sm:text-lg">
                        SoluÃ§Ã£o inovadora para o empresÃ¡rio do setor imobiliÃ¡rio de alto padrÃ£o. Cadastre ate 500 imoveis sem custo inicial, conecte-se a investidores qualificados e conte com concierge unico para acelerar negociacoes.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <div class="flex flex-wrap gap-4">
                            <a
                                href="{{ $heroUrl }}"
                                class="lux-gold-button text-sm uppercase tracking-[0.25em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lux-gold"
                                data-track-event="hero_cta_whatsapp"
                                data-track-payload='{"source":"hero_primary"}'
                                target="_blank"
                                rel="noopener"
                                aria-label="Falar com o concierge via WhatsApp"
                            >
                                Falar com o Concierge
                            </a>
                            <a
                                href="{{ $demoUrl }}"
                                class="lux-outline-button text-sm uppercase tracking-[0.25em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lux-gold"
                                data-track-event="hero_cta_whatsapp"
                                data-track-payload='{"source":"hero_demo"}'
                                target="_blank"
                                rel="noopener"
                                aria-label="Agendar demonstraÃ§Ã£o via WhatsApp"
                            >
                                Agendar DemonstraÃ§Ã£o
                            </a>
                        </div>
                        <a
                            href="{{ route('businessman.dashboard') }}"
                            class="lux-outline-button text-sm uppercase tracking-[0.25em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lux-gold"
                            aria-label="Ir para o dashboard do EmpresÃ¡rio Prime"
                        >
                            Ir para o Dashboard do EmpresÃ¡rio Prime
                        </a>
                    </div>
                    <div class="grid gap-5 sm:grid-cols-3">
                        <div class="flex flex-col gap-3 rounded-2xl border border-white/10 bg-white/10 p-5 text-white/80 shadow-[0_20px_60px_rgba(0,0,0,0.4)] transition hover:-translate-y-1 hover:shadow-[0_30px_80px_rgba(203,161,53,0.25)]">
                            <span class="text-xs uppercase tracking-[0.3em] text-white/60">Investidores</span>
                            <p class="text-2xl font-semibold text-white">Qualificados</p>
                            <p class="text-sm text-white/60">Rede qualificada e segmentada com apetite para alto padrÃ£o.</p>
                        </div>
                        <div class="flex flex-col gap-3 rounded-2xl border border-white/10 bg-white/10 p-5 text-white/80 shadow-[0_20px_60px_rgba(0,0,0,0.4)] transition hover:-translate-y-1 hover:shadow-[0_30px_80px_rgba(203,161,53,0.25)]">
                            <span class="text-xs uppercase tracking-[0.3em] text-white/60">Destaques</span>
                            <p class="text-2xl font-semibold text-white">16/mÃªs</p>
                            <p class="text-sm text-white/60">Visibilidade premium com curadoria de imÃ³veis icÃ´nicos.</p>
                        </div>
                        <div class="flex flex-col gap-3 rounded-2xl border border-white/10 bg-white/10 p-5 text-white/80 shadow-[0_20px_60px_rgba(0,0,0,0.4)] transition hover:-translate-y-1 hover:shadow-[0_30px_80px_rgba(203,161,53,0.25)]">
                            <span class="text-xs uppercase tracking-[0.3em] text-white/60">Concierge</span>
                            <p class="text-2xl font-semibold text-white">Atendimento Ãºnico</p>
                            <p class="text-sm text-white/60">Follow-up e war rooms sob medida para cada negociaÃ§Ã£o.</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="rounded-3xl border border-lux-gold/30 bg-black/60 p-10 shadow-[0_45px_120px_rgba(203,161,53,0.2)] backdrop-blur-xl">
                        <div class="flex flex-col gap-6">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.35em] text-white/50">Onboarding prime</p>
                                    <h2 class="mt-3 text-2xl font-semibold text-white">ExperiÃªncia concierge dedicada</h2>
                                </div>
                                <span class="lux-badge-outline">DisponÃ­vel 24/7</span>
                            </div>
                            <ul class="space-y-4 text-sm text-white/65">
                                <li class="flex items-start gap-3">
                                    <span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-lux-gold/20 text-lux-gold">1</span>
                                    <span>DiagnÃ³stico estratÃ©gico com consultoria para mapear imÃ³veis prioritÃ¡rios e metas de venda.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-lux-gold/20 text-lux-gold">2</span>
                                    <span>ConfiguraÃ§Ã£o do portfÃ³lio e roteiros de atendimento com materiais customizados.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-lux-gold/20 text-lux-gold">3</span>
                                    <span>Alinhamento jurÃ­dico e financeiro com parceiros homologados para seguranÃ§a nas transaÃ§Ãµes.</span>
                                </li>
                            </ul>
                            <div class="flex flex-wrap gap-3">
                                <a
                                    href="{{ $generalUrl }}"
                                    class="lux-outline-button text-xs uppercase tracking-[0.25em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lux-gold"
                                    data-track-event="hero_cta_whatsapp"
                                    data-track-payload='{"source":"hero_secondary"}'
                                    target="_blank"
                                    rel="noopener"
                                >
                                    Conversar agora
                                </a>
                                <a
                                    href="{{ $demoUrl }}"
                                    class="lux-gold-button text-xs uppercase tracking-[0.25em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black"
                                    data-track-event="hero_cta_whatsapp"
                                    data-track-payload='{"source":"hero_secondary_demo"}'
                                    target="_blank"
                                    rel="noopener"
                                >
                                    Agendar tour guiado
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed inset-x-4 bottom-4 z-40 mx-auto flex max-w-xl items-center justify-between gap-3 rounded-2xl border border-white/15 bg-black/90 px-4 py-3 shadow-[0_20px_60px_rgba(0,0,0,0.65)] backdrop-blur lg:hidden" role="region" aria-label="Atalhos para contato" data-track-section="mobile-cta">
            <div class="flex flex-col text-xs text-white/60">
                <span class="uppercase tracking-[0.35em] text-white/40">Concierge Ãºnico</span>
                <span class="font-semibold text-white">Atendimento via WhatsApp</span>
            </div>
            <div class="flex items-center gap-2">
                <a
                    href="{{ $heroUrl }}"
                    class="lux-gold-button px-4 py-2 text-[11px] uppercase tracking-[0.35em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black lg:hidden"
                    data-track-event="hero_cta_whatsapp"
                    data-track-payload='{"source":"hero_mobile_primary"}'
                    target="_blank"
                    rel="noopener"
                >
                    Concierge
                </a>
                <a
                    href="{{ $demoUrl }}"
                    class="lux-outline-button px-4 py-2 text-[11px] uppercase tracking-[0.35em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lux-gold lg:hidden"
                    data-track-event="hero_cta_whatsapp"
                    data-track-payload='{"source":"hero_mobile_demo"}'
                    target="_blank"
                    rel="noopener"
                >
                    DemonstraÃ§Ã£o
                </a>
            </div>
        </div>
    </header>

    <main class="relative bg-[#0B0B0B]">
        <section id="publico-alvo" class="lux-section">
            <div class="lux-container">
                <div class="flex flex-col gap-6 text-center">
                    <span class="lux-badge-gold mx-auto">Para quem Ã©</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">PÃºblico-alvo que valoriza tempo e performance</h2>
                    <p class="mx-auto max-w-2xl text-base text-white/70">
                        EmpresÃ¡rios do mercado imobiliÃ¡rio de alto padrÃ£o que buscam eficiÃªncia, seguranÃ§a e resultados mensurÃ¡veis em cada negociaÃ§Ã£o.
                    </p>
                </div>
                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    <article class="group rounded-2xl border border-white/10 bg-[#121212] p-8 shadow-[0_25px_70px_rgba(0,0,0,0.45)] transition hover:-translate-y-1 hover:border-lux-gold/50 hover:shadow-[0_35px_100px_rgba(203,161,53,0.25)]">
                        <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-full bg-lux-gold/15 text-xl text-lux-gold shadow-[0_0_25px_rgba(203,161,53,0.35)]">
                            â±ï¸
                        </div>
                        <h3 class="text-xl font-semibold text-white">Resultados &amp; Tempo</h3>
                        <p class="mt-3 text-sm text-white/70">EficiÃªncia que valoriza seu tempo e potencializa suas operaÃ§Ãµes.</p>
                    </article>
                    <article class="group rounded-2xl border border-white/10 bg-[#121212] p-8 shadow-[0_25px_70px_rgba(0,0,0,0.45)] transition hover:-translate-y-1 hover:border-lux-gold/50 hover:shadow-[0_35px_100px_rgba(203,161,53,0.25)]">
                        <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-full bg-lux-gold/15 text-xl text-lux-gold shadow-[0_0_25px_rgba(203,161,53,0.35)]">
                            ðŸ›¡ï¸
                        </div>
                        <h3 class="text-xl font-semibold text-white">SeguranÃ§a nas TransaÃ§Ãµes</h3>
                        <p class="mt-3 text-sm text-white/70">TransaÃ§Ãµes protegidas e respaldadas para sua tranquilidade.</p>
                    </article>
                    <article class="group rounded-2xl border border-white/10 bg-[#121212] p-8 shadow-[0_25px_70px_rgba(0,0,0,0.45)] transition hover:-translate-y-1 hover:border-lux-gold/50 hover:shadow-[0_35px_100px_rgba(203,161,53,0.25)]">
                        <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-full bg-lux-gold/15 text-xl text-lux-gold shadow-[0_0_25px_rgba(203,161,53,0.35)]">
                            ðŸ“ˆ
                        </div>
                        <h3 class="text-xl font-semibold text-white">Resultados Concretos</h3>
                        <p class="mt-3 text-sm text-white/70">Vendas tangÃ­veis e crescimento sustentÃ¡vel.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="beneficios" class="lux-section" data-track-section="benefits">
            <div class="lux-container grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
                <div class="space-y-6">
                    <span class="lux-badge-gold">BenefÃ­cios exclusivos</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Diferenciais para acelerar negÃ³cios prime</h2>
                    <p class="text-base text-white/70">Estrutura pronta para empresÃ¡rios que desejam alta performance sem fricÃ§Ãµes, com concierge Ãºnico e base de investidores proprietÃ¡ria.</p>
                                        <ul class="space-y-4 text-sm text-white/75">
                        <li class="flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-4">
                            <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-lux-gold/15 text-sm font-semibold text-lux-gold">01</span>
                            <span>Cadastre ate 500 imoveis de alto padrao sem custo inicial.</span>
                        </li>
                        <li class="flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-4">
                            <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-lux-gold/15 text-sm font-semibold text-lux-gold">02</span>
                            <span>Sistema identifica os investidores certo para seu imovel.</span>
                        </li>
                        <li class="flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-4">
                            <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-lux-gold/15 text-sm font-semibold text-lux-gold">03</span>
                            <span>Apenas 16 imoveis em destaque por mes para maxima visibilidade.</span>
                        </li>
                        <li class="flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-4">
                            <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-lux-gold/15 text-sm font-semibold text-lux-gold">04</span>
                            <span>Concierge intermedia negociacoes entre empresarios quando investidores de um se interessam por imoveis de outro, garantindo alinhamento e seguranca para ambos.</span>
                        </li>
                    </ul>
                </div>
                <div class="rounded-3xl border border-white/10 bg-[#111111] p-10 shadow-[0_30px_100px_rgba(203,161,53,0.2)]">
                    <div class="flex flex-col gap-6">
                        <div>
                            <h3 class="text-2xl font-semibold text-white">Radar de resultados</h3>
                            <p class="mt-2 text-sm text-white/70">Visualize indicadores-chave em tempo real para orientar estratÃ©gia de vendas e ativar o concierge.</p>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-2xl border border-lux-gold/30 bg-lux-gold/10 p-5 text-white">
                                <p class="text-xs uppercase tracking-[0.3em] text-white/70">Ticket mÃ©dio</p>
                                <p class="mt-2 text-2xl font-semibold">R$ 2,8M</p>
                                <p class="mt-1 text-xs text-white/70">AtualizaÃ§Ã£o contÃ­nua por IA + concierge.</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-5 text-white">
                                <p class="text-xs uppercase tracking-[0.3em] text-white/70">ConversÃ£o concierge</p>
                                <p class="mt-2 text-2xl font-semibold">+27%</p>
                                <p class="mt-1 text-xs text-white/70">MÃ©dia em 60 dias de operaÃ§Ã£o.</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-5 text-white">
                                <p class="text-xs uppercase tracking-[0.3em] text-white/70">Tempo de resposta</p>
                                <p class="mt-2 text-2xl font-semibold">&lt; 5 min</p>
                                <p class="mt-1 text-xs text-white/70">Concierge Ãºnico em canal direto.</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-5 text-white">
                                <p class="text-xs uppercase tracking-[0.3em] text-white/70">Imoveis ativos</p>
                                <p class="mt-2 text-2xl font-semibold">500</p>
                                <p class="mt-1 text-xs text-white/70">Limite gratuito para portfÃ³lio prime.</p>
                            </div>
                        </div>
                        <a
                            href="{{ $generalUrl }}"
                            class="lux-outline-button w-full justify-center text-xs uppercase tracking-[0.3em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lux-gold"
                            data-track-event="hero_cta_whatsapp"
                            data-track-payload='{"source":"benefits_cta"}'
                            target="_blank"
                            rel="noopener"
                        >
                            Acionar concierge para ativar benefÃ­cios
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="investidores" class="lux-section">
            <div class="lux-container grid gap-12 lg:grid-cols-2 lg:items-center">
                <div class="space-y-6">
                    <span class="lux-badge-gold">Base de investidores</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">ConexÃµes que impulsionam o fechamento</h2>
                    <p class="text-base text-white/70">A Prime Match Imo opera com curadoria ativa e relacionamento contÃ­nuo com investidores de alto padrÃ£o, entregando oportunidades qualificadas ao seu pipeline.</p>
                </div>
                <div class="grid gap-4">
                    <div class="timeline-step">
                        <span class="timeline-index">01</span>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Base de investidores qualificados</h3>
                            <p class="mt-1 text-sm text-white/70">Capazes de impulsionar vendas com agilidade e liquidez.</p>
                        </div>
                    </div>
                    <div class="timeline-step">
                        <span class="timeline-index">02</span>
                        <div>
                            <h3 class="text-lg font-semibold text-white">ConexÃµes estratÃ©gicas</h3>
                            <p class="mt-1 text-sm text-white/70">Relacionamento curado para elevar a probabilidade de fechamento.</p>
                        </div>
                    </div>
                    <div class="timeline-step">
                        <span class="timeline-index">03</span>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Rede ativa</h3>
                            <p class="mt-1 text-sm text-white/70">Investidores dispostos a negociar com suporte completo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="modelo-cobranca" class="lux-section">
            <div class="lux-container">
                <div class="flex flex-col gap-6 text-center">
                    <span class="lux-badge-gold mx-auto">Modelo de cobranÃ§a</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Clareza total sobre investimentos na plataforma</h2>
                    <p class="mx-auto max-w-3xl text-base text-white/70">Uso do sistema sem taxas, destaques opcionais para visibilidade imediata e success-fee de 1% alinhada Ã  performance de vendas intermediadas.</p>
                </div>
                <div class="mt-12 grid gap-6 lg:grid-cols-3">
                    <article class="plan-card">
                        <h3 class="text-xl font-semibold text-white">IsenÃ§Ã£o de Taxas</h3>
                        <p class="mt-3 text-sm text-white/70">Uso da plataforma e cadastro de ate 500 imoveis sem custo.</p>
                        <ul class="mt-6 space-y-3 text-sm text-white/70">
                            <li>GestÃ£o completa do portfÃ³lio prime.</li>
                            <li>Dashboard com mÃ©tricas em tempo real.</li>
                            <li>Concierge dedicado para suporte estratÃ©gico.</li>
                        </ul>
                        <a
                            href="{{ $generalUrl }}"
                            class="plan-button focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lux-gold"
                            data-track-event="pricing_highlight_cta"
                            data-track-payload='{"source":"pricing_free"}'
                            target="_blank"
                            rel="noopener"
                        >
                            Ativar conta gratuita
                        </a>
                    </article>
                    <article class="plan-card border-lux-gold/50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-white">Destaques Exclusivos</h3>
                            <span class="badge-outline text-xs uppercase tracking-[0.35em] text-lux-gold">Opcional</span>
                        </div>
                        <p class="mt-3 text-sm text-white/70">Impulsione imÃ³veis com vitrines premium em canais selecionados.</p>
                        <ul class="mt-6 space-y-3 text-sm text-white/70">
                            <li>R$ 500 por 1 mÃªs de destaque.</li>
                            <li>R$ 800 por 2 meses de destaque.</li>
                            <li>Verba integral para impulsionar visibilidade.</li>
                        </ul>
                        <a
                            href="{{ $highlightUrl }}"
                            class="plan-button border-lux-gold bg-lux-gold/10 text-lux-gold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lux-gold"
                            data-track-event="pricing_highlight_cta"
                            data-track-payload='{"source":"pricing_highlight"}'
                            target="_blank"
                            rel="noopener"
                        >
                            Falar sobre destaque
                        </a>
                    </article>
                    <article class="plan-card">
                        <h3 class="text-xl font-semibold text-white">Success-Fee</h3>
                        <p class="mt-3 text-sm text-white/70">1% sobre o valor da venda intermediada, alinhado Ã  performance.</p>
                        <ul class="mt-6 space-y-3 text-sm text-white/70">
                            <li>Modelo transparente e baseado em resultados.</li>
                            <li>Reinvestimento contÃ­nuo na evoluÃ§Ã£o da plataforma.</li>
                            <li>Suporte concierge em todas as etapas do fechamento.</li>
                        </ul>
                        <a
                            href="{{ $generalUrl }}"
                            class="plan-button focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lux-gold"
                            data-track-event="pricing_highlight_cta"
                            data-track-payload='{"source":"pricing_success_fee"}'
                            target="_blank"
                            rel="noopener"
                        >
                            Entender success-fee 1%
                        </a>
                    </article>
                </div>
            </div>
        </section>

        <section id="suporte" class="lux-section">
            <div class="lux-container">
                <div class="flex flex-col gap-6 text-center">
                    <span class="lux-badge-gold mx-auto">Suporte prime</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Consultoria e acompanhamento contÃ­nuos</h2>
                    <p class="mx-auto max-w-3xl text-base text-white/70">Equipe concierge atua como extensÃ£o da sua operaÃ§Ã£o, garantindo gestÃ£o eficiente e inteligÃªncia de dados para decisÃµes rÃ¡pidas.</p>
                </div>
                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    <article class="lux-card">
                        <h3 class="text-xl font-semibold text-white">Consultoria Personalizada</h3>
                        <p class="mt-3 text-sm text-white/70">Apoio na gestÃ£o eficiente da equipe do empresÃ¡rio, com planos de aÃ§Ã£o sob medida.</p>
                    </article>
                    <article class="lux-card">
                        <h3 class="text-xl font-semibold text-white">Acompanhamento ContÃ­nuo</h3>
                        <p class="mt-3 text-sm text-white/70">Suporte recorrente para maximizar resultados e manter ritmo de vendas elevado.</p>
                    </article>
                    <article class="lux-card">
                        <h3 class="text-xl font-semibold text-white">GestÃ£o Eficiente</h3>
                        <p class="mt-3 text-sm text-white/70">Foco em otimizar processos de venda e operaÃ§Ã£o, com insights acionÃ¡veis.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="parcerias" class="lux-section">
            <div class="lux-container grid gap-10 lg:grid-cols-2 lg:items-center">
                <div class="space-y-6">
                    <span class="lux-badge-gold">Parcerias estratÃ©gicas</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">DocumentaÃ§Ã£o imobiliÃ¡ria e consultoria jurÃ­dica</h2>
                    <p class="text-base text-white/70">Trabalhamos com escritÃ³rios parceiros especializados para garantir conformidade e seguranÃ§a em cada transaÃ§Ã£o de alto padrÃ£o.</p>
                </div>
                <div class="space-y-4">
                    <article class="rounded-2xl border border-white/10 bg-white/5 p-6 text-white shadow-[0_20px_70px_rgba(0,0,0,0.45)]">
                        <h3 class="text-lg font-semibold text-white">DocumentaÃ§Ã£o &amp; Consultoria</h3>
                        <p class="mt-2 text-sm text-white/70">Parceiros especializados asseguram conformidade integral e diligÃªncia rÃ¡pida.</p>
                    </article>
                    <article class="rounded-2xl border border-white/10 bg-white/5 p-6 text-white shadow-[0_20px_70px_rgba(0,0,0,0.45)]">
                        <h3 class="text-lg font-semibold text-white">Agilidade e SeguranÃ§a</h3>
                        <p class="mt-2 text-sm text-white/70">EscritÃ³rios homologados agilizam etapas documentais crÃ­ticas.</p>
                    </article>
                    <article class="rounded-2xl border border-white/10 bg-white/5 p-6 text-white shadow-[0_20px_70px_rgba(0,0,0,0.45)]">
                        <h3 class="text-lg font-semibold text-white">ProteÃ§Ã£o e Confiabilidade</h3>
                        <p class="mt-2 text-sm text-white/70">TransparÃªncia e padrÃ£o elevado em todas as negociaÃ§Ãµes.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="transparencia" class="lux-section">
            <div class="lux-container">
                <div class="flex flex-col gap-6 text-center">
                    <span class="lux-badge-gold mx-auto">TransparÃªncia e alinhamento</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Relacionamentos sustentados pela confianÃ§a</h2>
                    <p class="mx-auto max-w-3xl text-base text-white/70">Compromisso total com clareza, suporte contÃ­nuo e objetivos compartilhados para garantir uma parceria ganha-ganha.</p>
                </div>
                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    <article class="rounded-2xl border border-white/10 bg-[#111111] p-8 text-white shadow-[0_20px_70px_rgba(0,0,0,0.45)]">
                        <h3 class="text-xl font-semibold text-white">Compromisso Transparente</h3>
                        <p class="mt-3 text-sm text-white/70">GestÃ£o de expectativas e comunicaÃ§Ã£o clara em cada etapa.</p>
                    </article>
                    <article class="rounded-2xl border border-white/10 bg-[#111111] p-8 text-white shadow-[0_20px_70px_rgba(0,0,0,0.45)]">
                        <h3 class="text-xl font-semibold text-white">Suporte ContÃ­nuo</h3>
                        <p class="mt-3 text-sm text-white/70">Acesso facilitado ao concierge para decisÃµes rÃ¡pidas.</p>
                    </article>
                    <article class="rounded-2xl border border-white/10 bg-[#111111] p-8 text-white shadow-[0_20px_70px_rgba(0,0,0,0.45)]">
                        <h3 class="text-xl font-semibold text-white">Alinhamento de Objetivos</h3>
                        <p class="mt-3 text-sm text-white/70">Metas compartilhadas para garantir ganhos mÃºtuos.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="cta-final" class="lux-section">
            <div class="lux-container rounded-3xl border border-lux-gold/30 bg-gradient-to-br from-[#121212] via-[#0B0B0B] to-[#1a1a1a] p-12 shadow-[0_40px_110px_rgba(203,161,53,0.25)]">
                <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                    <div class="space-y-6">
                        <span class="lux-badge-gold">Ganhe eficiÃªncia agora</span>
                        <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Ganhe eficiÃªncia, seguranÃ§a e resultados concretos.</h2>
                        <div class="grid gap-4 text-sm text-white/75 sm:grid-cols-3">
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                <h3 class="text-base font-semibold text-white">Tempo valioso</h3>
                                <p class="mt-2 text-sm text-white/70">Foque no estratÃ©gico com menos tarefas administrativas.</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                <h3 class="text-base font-semibold text-white">SeguranÃ§a e confianÃ§a</h3>
                                <p class="mt-2 text-sm text-white/70">Ambiente seguro com consultoria personalizada.</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                <h3 class="text-base font-semibold text-white">Resultados concretos</h3>
                                <p class="mt-2 text-sm text-white/70">ROI com investidores qualificados e modelo claro.</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6 rounded-3xl border border-white/10 bg-black/60 p-8 shadow-[0_30px_90px_rgba(203,161,53,0.22)]">
                        <p class="text-sm text-white/70">Todo contato Ã© direcionado ao concierge Ãºnico via WhatsApp para garantir atendimento personalizado.</p>
                        <div class="flex flex-wrap gap-4">
                            <a
                                href="{{ $heroUrl }}"
                                class="lux-gold-button text-sm uppercase tracking-[0.25em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black"
                                data-track-event="hero_cta_whatsapp"
                                data-track-payload='{"source":"cta_final_primary"}'
                                target="_blank"
                                rel="noopener"
                            >
                                Falar com o Concierge
                            </a>
                            <a
                                href="{{ $demoUrl }}"
                                class="lux-outline-button text-sm uppercase tracking-[0.25em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lux-gold"
                                data-track-event="hero_cta_whatsapp"
                                data-track-payload='{"source":"cta_final_demo"}'
                                target="_blank"
                                rel="noopener"
                            >
                                Agendar DemonstraÃ§Ã£o
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contato" class="lux-section">
            <div class="lux-container">
                <div class="grid gap-10 rounded-3xl border border-white/10 bg-[#111111] p-10 shadow-[0_30px_100px_rgba(0,0,0,0.45)] lg:grid-cols-2 lg:items-center">
                    <div class="space-y-4">
                        <span class="lux-badge-gold">Contato direto</span>
                        <h2 class="font-poppins text-3xl font-semibold text-white">Concierge Prime Match Imo</h2>
                        <p class="text-base text-white/70">Centralize o relacionamento pelo concierge Ãºnico. Todos os botÃµes desta pÃ¡gina direcionam para o WhatsApp oficial.</p>
                    </div>
                    <div class="space-y-4 text-sm text-white/75">
                        <p><strong class="text-white">WhatsApp:</strong> <a class="text-lux-gold underline-offset-4 hover:underline" href="{{ $heroUrl }}" target="_blank" rel="noopener" data-track-event="contact_footer_cta" data-track-payload='{"source":"contact_whatsapp"}'>+55 (14) 99684-5854</a></p>
                        <p><strong class="text-white">E-mail:</strong> <a class="text-lux-gold underline-offset-4 hover:underline" href="mailto:primematchimo@gmail.com">primematchimo@gmail.com</a></p>
                        <p><strong class="text-white">Site:</strong> <span>www.primematchimo.com</span></p>
                        <div class="flex flex-wrap gap-4 text-xs uppercase tracking-[0.3em] text-white/40">
                            <a href="#" class="hover:text-white">PolÃ­tica de privacidade</a>
                            <a href="#" class="hover:text-white">Termos de uso</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        window.track = window.track || function (eventName, data) {
            console.log('[track]', eventName, data || {});
        };

        document.addEventListener('DOMContentLoaded', () => {
            const benefitsSection = document.querySelector('[data-track-section="benefits"]');
            if (benefitsSection) {
                let benefitsTracked = false;
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (!benefitsTracked && entry.isIntersecting) {
                            benefitsTracked = true;
                            track('benefits_view', { section: 'benefits' });
                        }
                    });
                }, { threshold: 0.35 });
                observer.observe(benefitsSection);
            }

            document.querySelectorAll('[data-track-event]').forEach((element) => {
                element.addEventListener('click', () => {
                    const eventName = element.getAttribute('data-track-event');
                    const payloadRaw = element.getAttribute('data-track-payload');
                    let payload = {};
                    if (payloadRaw) {
                        try {
                            payload = JSON.parse(payloadRaw);
                        } catch (error) {
                            console.warn('Invalid track payload', error);
                        }
                    }
                    track(eventName, payload);
                });
            });
        });
    </script>
@endpush











