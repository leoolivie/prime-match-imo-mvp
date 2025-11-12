@extends('layouts.app')

@section('title', 'Prime Match Imo · Curadoria Concierge')

@section('content')
@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
@endphp

<section class="lux-hero">
    <div class="lux-container py-20 lg:py-28">
        <div class="grid gap-16 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-10">
                <span class="lux-badge-gold">Concierge único · WhatsApp 24/7</span>
                <div class="space-y-6">
                    <h1 class="font-poppins text-4xl font-semibold leading-tight text-white sm:text-5xl">
                        Imóveis de luxo conectados ao seu capital com curadoria concierge
                    </h1>
                    <p class="max-w-2xl text-base text-white/70 sm:text-lg">
                        Matchmaking imobiliário premium para investidores e empresários. Um único concierge orquestra filtros avançados, dossiês financeiros e negociação assistida direto no WhatsApp.
                    </p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('investor.catalog') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">
                        Sou investidor
                    </a>
                    <a href="{{ route('landing.businessman') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">
                        Sou empresário
                    </a>
                    <a href="{{ ConciergeLink::build('investidor_card', [
                            'city' => 'São Paulo',
                            'type' => 'oportunidades prime',
                            'budget_min' => 5000000,
                            'budget_max' => 25000000,
                        ], [
                            'user_type' => 'investidor',
                            'source' => 'hero',
                        ]) }}"
                        target="_blank"
                        rel="noopener"
                        class="lux-outline-button text-xs uppercase tracking-[0.3em]">
                        Falar com o concierge
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
                <p class="text-lg text-white/60">Sem formulários intermináveis: o concierge recebe seu briefing, recomenda ativos alinhados e acompanha cada movimento pelo WhatsApp.</p>
            </div>
            <div class="space-y-4">
                <div class="timeline-step">
                    <div class="timeline-index">01</div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Cadastre ou explore</h3>
                        <p class="text-sm text-white/60">Empresários sobem fotos, ficha técnica e documentos. Investidores exploram vitrine filtrando cidade, tipologia, budget e amenidades.</p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-index">02</div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Clique em "Falar com o Concierge"</h3>
                        <p class="text-sm text-white/60">Cada CTA abre o WhatsApp com mensagem pronta. O concierge único responde em minutos e já direciona próximos passos.</p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-index">03</div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Negociação conduzida pelo concierge</h3>
                        <p class="text-sm text-white/60">Visitas, propostas e diligência ocorrem em um canal seguro. Você acompanha o histórico e recebe atualizações com métricas agregadas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lux-section">
    <div class="lux-container space-y-10">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <span class="lux-badge-outline">Imóveis em destaque</span>
                <h2 class="mt-4 font-poppins text-3xl font-semibold text-white">Curadoria concierge com prioridade de negociação</h2>
            </div>
            <a href="{{ route('investor.catalog') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver vitrine completa</a>
        </div>
        <div x-data="{
                active: 0,
                autoplay: null,
                init() {
                    this.autoplay = setInterval(() => {
                        if (this.total > 0) {
                            this.active = (this.active + 1) % this.total;
                        }
                    }, 6000);
                },
                get total() {
                    return this.$refs?.slides?.children?.length ?? 0;
                }
            }" x-cloak class="space-y-8">
            <div class="relative overflow-hidden">
                <div class="grid gap-6 md:grid-cols-2" x-ref="slides">
                    @forelse($featured as $index => $property)
                        @php
                            $image = optional($property->primaryImage)->path
                                ? asset('storage/' . $property->primaryImage->path)
                                : asset('images/placeholders/luxury-property.svg');
                            $amenities = collect($property->features ?? [])->filter()->take(3);
                        @endphp
                        <article x-cloak x-show="active === {{ $index }}" x-transition.opacity.duration.500ms class="lux-card-dark grid gap-6 md:grid-cols-[1.1fr_0.9fr]">
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <span class="lux-badge-gold">{{ $property->highlighted ? 'Formato destaque premium' : 'Disponível' }}</span>
                                    <h3 class="text-2xl font-semibold text-white">{{ $property->title }}</h3>
                                    <p class="text-sm uppercase tracking-[0.3em] text-white/60">{{ $property->city }} • {{ $property->state }}</p>
                                </div>
                                <div class="flex flex-wrap gap-3 text-sm text-white/70">
                                    <span class="badge-outline">{{ Format::currency($property->price) }}</span>
                                    @if($property->area)
                                        <span class="badge-outline">{{ Format::area($property->area) }}</span>
                                    @endif
                                    @if($property->bedrooms)
                                        <span class="badge-outline">{{ $property->bedrooms }} quartos</span>
                                    @endif
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @forelse($amenities as $amenity)
                                        <span class="lux-badge-outline">{{ $amenity }}</span>
                                    @empty
                                        <span class="lux-badge-outline">Amenidades sob consulta</span>
                                    @endforelse
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('properties.show', $property) }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver imóvel</a>
                                    <a href="{{ ConciergeLink::forInvestorCard($property) }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com o concierge</a>
                                </div>
                            </div>
                            <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-[#0B0B0B]">
                                <img src="{{ $image }}" alt="{{ $property->title }}" class="h-full w-full object-cover" loading="lazy" />
                            </div>
                        </article>
                    @empty
                        <article x-cloak class="lux-card-dark">
                            <h3 class="text-xl font-semibold text-white">Curadoria em preparação</h3>
                            <p class="mt-3 text-sm text-white/60">Cadastre imóveis premium ou explore a vitrine para liberar destaques acompanhados pelo concierge.</p>
                        </article>
                    @endforelse
                </div>
            </div>
            @if($featured->count() > 1)
                <div class="flex justify-center gap-2">
                    @foreach($featured as $index => $_)
                        <button type="button" class="h-2 w-10 rounded-full transition" :class="active === {{ $index }} ? 'bg-lux-gold shadow-[0_0_25px_rgba(255,215,0,0.4)]' : 'bg-white/10 hover:bg-white/30'" @click="active = {{ $index }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
