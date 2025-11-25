@extends('layouts.app')

@section('title', 'Prime Match Imo — Matchmaking Premium')

@section('content')
@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
@endphp

@include('components.prime-featured-section', [
    'featured' => $featured,
    'title' => 'Imóveis Prime em Destaque',
    'subtitle' => 'Coleção selecionada manualmente pelo Concierge Master para abrir sua experiência com ativos exclusivos.',
])

<section class="lux-hero">
    <div class="lux-container py-20 lg:py-28">
        <div class="grid gap-16 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-10">
                <span class="lux-badge-gold">Plataforma de matchmaking curado • Concierge + IA</span>
                <div class="space-y-6">
                    <h1 class="font-poppins text-4xl font-semibold leading-tight text-white sm:text-5xl">
                        Imóveis de alto padrão conectados ao investidor certo.
                    </h1>
                    <p class="max-w-2xl text-base text-white/75 sm:text-lg">
                        A Prime Match Imo é uma plataforma de matchmaking imobiliário premium.
                        Com curadoria humana + IA e um Concierge Prime, conectamos investidores de alto padrão a imóveis exclusivos de empresários prime.
                        Não somos uma imobiliária. Somos a ponte segura entre capital e ativos raros.
                    </p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('investor.catalog') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">
                        Sou Investidor Prime
                    </a>
                    <a href="{{ route('landing.businessman') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">
                        Sou Empresário Prime
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
                        class="lux-outline-button text-xs uppercase tracking-[0.3em]">
                        Falar com Concierge (WhatsApp 24/7)
                    </a>
                </div>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="lux-card-surface">
                        <p class="text-xs uppercase tracking-[0.35em] text-white/50">Visitas assistidas</p>
                        <p class="mt-3 text-2xl font-semibold text-white">Agenda prioritária</p>
                        <p class="mt-1 text-sm text-white/60">O concierge organiza pré-briefing, visita e follow-up no mesmo fluxo.</p>
                    </div>
                    <div class="lux-card-surface">
                        <p class="text-xs uppercase tracking-[0.35em] text-white/50">Curadoria prime</p>
                        <p class="mt-3 text-2xl font-semibold text-white">Filtro humano + IA</p>
                        <p class="mt-1 text-sm text-white/60">Seleção manual com dados financeiros, documentos e avaliação de risco.</p>
                    </div>
                    <div class="lux-card-surface">
                        <p class="text-xs uppercase tracking-[0.35em] text-white/50">Negociação</p>
                        <p class="mt-3 text-2xl font-semibold text-white">War room no WhatsApp</p>
                        <p class="mt-1 text-sm text-white/60">Você aprova o imóvel, o concierge conduz proposta e diligência em tempo real.</p>
                    </div>
                </div>
            </div>
            <div class="lux-card-dark space-y-8">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Painel concierge</p>
                        <h3 class="text-2xl font-semibold text-white">Pipeline premium monitorado</h3>
                    </div>
                    <span class="lux-badge-outline">Curadoria concierge</span>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Tickets ativos</p>
                        <p class="mt-3 text-3xl font-semibold text-white">R$ 280M+</p>
                        <p class="mt-2 text-sm text-white/60">Negociações em andamento com SLA de 5 minutos no WhatsApp.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Tempo médio</p>
                        <p class="mt-3 text-3xl font-semibold text-white">3 horas</p>
                        <p class="mt-2 text-sm text-white/60">Do briefing à pré-proposta entregue ao investidor.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Imóveis curados</p>
                        <p class="mt-3 text-3xl font-semibold text-white">+120</p>
                        <p class="mt-2 text-sm text-white/60">Cada ativo possui galeria, ficha técnica e amenidades verificadas.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Conversão concierge</p>
                        <p class="mt-3 text-3xl font-semibold text-white">18%</p>
                        <p class="mt-2 text-sm text-white/60">Cliques em WhatsApp evoluem para proposta formal acompanhada.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lux-section">
    <div class="lux-container">
        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="space-y-5">
                <span class="lux-badge-outline">Como funciona</span>
                <h2 class="font-poppins text-4xl font-semibold text-white">Três passos para a Prime Match Imo entregar o imóvel ideal</h2>
                <p class="text-lg text-white/60">Intermediação curada: o concierge recebe seu briefing, valida perfil e acompanha cada movimento pelo WhatsApp.</p>
            </div>
            <div class="space-y-4">
                <div class="timeline-step">
                    <div class="timeline-index">01</div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Cadastre ou explore</h3>
                        <p class="text-sm text-white/60">Empresários cadastram imóveis exclusivos. Investidores exploram oportunidades alinhadas ao seu objetivo.</p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-index">02</div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Concierge filtra e valida</h3>
                        <p class="text-sm text-white/60">Você fala direto com o Concierge Prime no WhatsApp. Ele entende seu perfil e seleciona os ativos ideais.</p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-index">03</div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Intermediação até o fechamento</h3>
                        <p class="text-sm text-white/60">Organizamos visitas, dossiê, proposta e negociação assistida. Sempre com segurança, discrição e agilidade.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lux-section">
    <div class="lux-container space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-3xl font-semibold text-white">Benefícios Prime</h2>
            <span class="lux-badge-outline">Intermediação premium</span>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            <div class="lux-card-dark space-y-3">
                <h3 class="text-xl font-semibold text-white">Curadoria Prime</h3>
                <p class="text-sm text-white/70">Seleção rígida de imóveis com análise humana + IA.</p>
            </div>
            <div class="lux-card-dark space-y-3">
                <h3 class="text-xl font-semibold text-white">Exclusividade</h3>
                <p class="text-sm text-white/70">Imóveis únicos na plataforma, sem duplicidade e sem briga de anúncio.</p>
            </div>
            <div class="lux-card-dark space-y-3">
                <h3 class="text-xl font-semibold text-white">Concierge 24/7</h3>
                <p class="text-sm text-white/70">Um único concierge conduz toda a jornada no WhatsApp.</p>
            </div>
        </div>
    </div>
</section>

@endsection
