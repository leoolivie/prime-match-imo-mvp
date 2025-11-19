@props([
    'featured' => collect(),
    'title' => 'Imóveis em destaque',
    'subtitle' => 'Seleção exclusiva curada pelo Master para impactar investidores.',
])

@php
    use App\Support\ConciergeLink;
    use App\Support\Format;

    $featuredCount = $featured->count();
@endphp

<section class="relative overflow-hidden bg-[#040404] py-16 sm:py-20">
    <div class="absolute inset-0 bg-gradient-to-br from-[#111111] via-[#050505] to-[#0f0f0f]"></div>
    <div class="absolute inset-0 opacity-40" style="background: radial-gradient(circle at top left, rgba(212,175,55,0.25), transparent 55%), radial-gradient(circle at bottom right, rgba(0,0,0,0.65), transparent 60%);"></div>
    <div class="relative lux-container space-y-10">
        <div class="flex flex-col items-center gap-6 text-center">
            <div class="max-w-4xl space-y-4">
                <span class="lux-badge-gold">Coleção prime</span>
                <h2 class="font-poppins text-4xl font-semibold text-white sm:text-5xl">{{ $title }}</h2>
                <p class="max-w-3xl text-sm text-white/60 sm:text-base">{{ $subtitle }}</p>
            </div>
            <p class="max-w-3xl text-sm font-medium uppercase tracking-[0.2em] text-white/70 sm:text-base">
                Atendimento Prime, imóveis selecionados e oportunidades exclusivas para quem investe em alto padrão.
            </p>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('investor.catalog') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver vitrine completa</a>
                <a href="{{ route('investor.dashboard') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Entrar como investidor</a>
            </div>
        </div>

        @if($featured->isEmpty())
            <div class="rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                A curadoria prime está em preparação. Novos imóveis selecionados serão exibidos aqui em breve.
            </div>
        @else
            <div
                class="space-y-8"
                data-featured-carousel
                data-carousel-interval="40000"
                @if($featuredCount <= 1) data-carousel-static="true" @endif
            >
                <div class="relative">
                    <div data-featured-track>
                        @foreach($featured as $property)
                            @php
                                $isActive = $loop->first;
                                $statusLabels = [
                                    'available' => 'Disponível',
                                    'reserved' => 'Reservado',
                                    'unavailable' => 'Indisponível',
                                ];
                                $statusLabel = $statusLabels[$property->status ?? 'available'] ?? 'Disponível';
                                $userType = auth()->check() && auth()->user()->isBusinessman() ? 'empresario' : 'investidor';
                                $conciergeUrl = ConciergeLink::forFeaturedProperty($property, $userType);
                            @endphp
                            <article
                                data-featured-slide
                                @class([
                                    'group relative mx-auto w-full max-w-3xl overflow-hidden rounded-[36px] border border-white/10 bg-[#050505]/95 text-left shadow-[0_40px_120px_rgba(0,0,0,0.55)] backdrop-blur-sm transition duration-500 ease-out motion-safe:animate-fade-in-up sm:w-[90%] md:max-w-4xl lg:mx-auto lg:w-[70%] lg:max-w-none xl:w-[60%]',
                                    'hover:-translate-y-2 hover:scale-[1.01] hover:border-lux-gold hover:shadow-[0_35px_120px_rgba(203,161,53,0.45)]' => $featuredCount > 1,
                                    'hidden opacity-0 pointer-events-none' => !$isActive,
                                ])
                                aria-hidden="{{ $isActive ? 'false' : 'true' }}"
                            >
                                <span class="absolute left-1/2 top-6 z-10 -translate-x-1/2 rounded-full bg-gradient-to-r from-[#f2d57b] via-[#f8e6a7] to-[#cba135] px-5 py-1 text-[11px] font-semibold uppercase tracking-[0.4em] text-[#1d1200] shadow-[0_12px_35px_rgba(203,161,53,0.45)]">
                                    Imóvel Prime
                                </span>
                                <div class="relative h-80 overflow-hidden" data-featured-media-container>
                                    @if($property->video_url)
                                        <video
                                            data-featured-media
                                            class="h-full w-full object-cover"
                                            playsinline
                                            muted
                                            loop
                                            preload="metadata"
                                            @if($isActive) autoplay @endif
                                        >
                                            <source src="{{ $property->video_url }}" type="video/mp4">
                                        </video>
                                    @else
                                        <img
                                            data-featured-media
                                            src="{{ $property->hero_image_url }}"
                                            alt="{{ $property->title }}"
                                            class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                            loading="lazy"
                                        >
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-b from-black/15 via-transparent to-black/85"></div>
                                        <div class="absolute left-6 top-6 flex items-center gap-2 rounded-full border border-white/20 bg-black/60 px-3 py-1 text-[11px] uppercase tracking-[0.35em] text-white">
                                            <span>{{ strtoupper($statusLabel) }}</span>
                                        </div>
                                    <div class="absolute bottom-6 left-6 right-6">
                                        <h3 class="font-poppins text-2xl font-semibold text-white">{{ $property->title }}</h3>
                                        <p class="mt-1 text-xs uppercase tracking-[0.35em] text-white/70">{{ $property->city }} • {{ $property->state }}</p>
                                    </div>
                                </div>
                                <div class="space-y-7 p-8">
                                    <div class="flex flex-wrap gap-3 text-xs uppercase tracking-[0.25em] text-white/65">
                                        <span class="rounded-full border border-white/10 bg-[#111111] px-3 py-1 text-white">{{ Format::currency($property->price) }}</span>
                                        @if($property->area_m2)
                                            <span class="rounded-full border border-white/10 bg-[#111111] px-3 py-1 text-white/80">{{ Format::area($property->area_m2) }}</span>
                                        @endif
                                        @if($property->bedrooms)
                                            <span class="rounded-full border border-white/10 bg-[#111111] px-3 py-1 text-white/80">{{ $property->bedrooms }} quartos</span>
                                        @endif
                                        @if($property->parking_spaces)
                                            <span class="rounded-full border border-white/10 bg-[#111111] px-3 py-1 text-white/80">{{ $property->parking_spaces }} vagas</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-white/70">{{ $property->short_description ?? 'Experiência prime com concierge dedicado e documentação completa sob demanda.' }}</p>
                                    <div class="space-y-4 rounded-2xl border border-[#cba135]/30 bg-[#0b0b0b]/80 p-5 text-sm text-[#f5e7c2] shadow-[0_25px_80px_rgba(203,161,53,0.15)]">
                                        <p class="font-semibold uppercase tracking-[0.3em] text-[#f5d67c]">Concierge Prime</p>
                                        <p class="text-[13px] leading-relaxed text-[#f6edd5]">
                                            Investidor Prime tem atendimento e benefícios exclusivos nos Imóveis Prime.
                                            Fale com o Concierge Prime e invista no melhor do alto padrão com segurança, discrição e curadoria personalizada.
                                        </p>
                                    </div>
                                        <div class="grid gap-3 text-center sm:grid-cols-2">
                                            <a href="{{ $property->cta_view_url ?? route('investor.catalog') }}" class="flex items-center justify-center rounded-full border border-[#cba135]/40 bg-transparent px-4 py-3 text-xs font-semibold uppercase tracking-[0.3em] text-white transition duration-300 hover:border-[#f0d27a] hover:bg-[#0f0f0f]/80 hover:text-white/95">Ver imóvel</a>
                                            <a href="{{ $conciergeUrl }}" target="_blank" rel="noopener" class="flex items-center justify-center gap-2 rounded-full border border-[#f0d27a]/70 bg-gradient-to-r from-[#f9e7b4] via-[#f6de95] to-[#cba135] px-4 py-3 text-xs font-semibold uppercase tracking-[0.35em] text-[#1a1202] shadow-[0_20px_60px_rgba(203,161,53,0.35)] transition duration-300 hover:scale-[1.02] hover:shadow-[0_30px_80px_rgba(203,161,53,0.45)]">
                                                <span class="text-base">✶</span>
                                                Falar com o Concierge Prime
                                            </a>
                                        </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if($featuredCount > 1)
                        <div class="pointer-events-none absolute inset-y-0 left-0 right-0 z-20 flex items-center justify-between px-3 sm:px-8">
                            <button
                                type="button"
                                data-carousel-nav="prev"
                                class="pointer-events-auto group flex items-center gap-3 rounded-full border border-white/15 bg-black/55 px-4 py-3 text-left text-white/70 shadow-[0_15px_45px_rgba(0,0,0,0.45)] backdrop-blur-sm transition hover:border-lux-gold/70 hover:text-white"
                                aria-label="Imóvel anterior"
                            >
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/20 bg-gradient-to-br from-white/15 via-white/10 to-transparent text-xl font-semibold text-white transition group-hover:border-lux-gold group-hover:text-lux-gold">
                                    &larr;
                                </span>
                                <span class="hidden text-[10px] uppercase tracking-[0.45em] text-white/60 sm:inline-block">Anterior</span>
                            </button>
                            <button
                                type="button"
                                data-carousel-nav="next"
                                class="pointer-events-auto group flex items-center gap-3 rounded-full border border-white/15 bg-black/55 px-4 py-3 text-right text-white/70 shadow-[0_15px_45px_rgba(0,0,0,0.45)] backdrop-blur-sm transition hover:border-lux-gold/70 hover:text-white"
                                aria-label="Próximo imóvel"
                            >
                                <span class="hidden text-[10px] uppercase tracking-[0.45em] text-white/60 sm:inline-block">Próximo</span>
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/20 bg-gradient-to-br from-white/15 via-white/10 to-transparent text-xl font-semibold text-white transition group-hover:border-lux-gold group-hover:text-lux-gold">
                                    &rarr;
                                </span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>
