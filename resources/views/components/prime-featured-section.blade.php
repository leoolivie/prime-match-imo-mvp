@props([
    'featured' => collect(),
    'title' => 'Imóveis em Destaque Prime',
    'subtitle' => 'Coleção selecionada manualmente pelo Concierge Master para abrir sua experiência com ativos exclusivos.',
])

@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
    use Illuminate\Support\Str;

    $featuredCount = $featured->count();
@endphp

<section class="relative overflow-hidden bg-[#040404] py-16 sm:py-20">
    <div class="absolute inset-0 bg-gradient-to-br from-[#111111] via-[#050505] to-[#0f0f0f]"></div>
    <div class="absolute inset-0 opacity-40" style="background: radial-gradient(circle at top left, rgba(212,175,55,0.25), transparent 55%), radial-gradient(circle at bottom right, rgba(0,0,0,0.65), transparent 60%);"></div>

    <style>
        @keyframes primeSlideIn {
            0% { opacity: 0; transform: translateY(14px) scale(.985); filter: saturate(.9) contrast(.95); }
            100% { opacity: 1; transform: translateY(0) scale(1); filter: saturate(1) contrast(1); }
        }
        .prime-slide-enter { animation: primeSlideIn .9s cubic-bezier(.16,1,.3,1) both; }

        @keyframes primeModalIn {
            0% { opacity: 0; transform: translateY(10px) scale(.98); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .prime-modal-enter { animation: primeModalIn .55s cubic-bezier(.16,1,.3,1) both; }

        .prime-progress-bar {
            width: 0%;
            transition-timing-function: linear;
        }
    </style>

    <div class="relative lux-container space-y-10">
        <div class="flex flex-col items-center gap-6 text-center">
            <div class="max-w-4xl space-y-4">
                <span class="lux-badge-gold">Colecao prime</span>
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
                A curadoria prime esta em preparacao. Novos imoveis selecionados serao exibidos aqui em breve.
            </div>
        @else
            <div
                class="space-y-6"
                data-featured-carousel
                data-carousel-interval="40000"
                data-carousel-hover-pause="true"
                @if($featuredCount <= 1) data-carousel-static="true" @endif
            >
                <div class="relative">
                    <div data-featured-track>
                        @foreach($featured as $property)
                            @php
                                $isActive = $loop->first;

                                $statusLabels = [
                                    'available' => 'Disponivel',
                                    'reserved' => 'Reservado',
                                    'unavailable' => 'Indisponivel',
                                ];
                                $statusLabel = $statusLabels[$property->status ?? 'available'] ?? 'Disponivel';

                                $userType = auth()->check() && auth()->user()->isBusinessman()
                                    ? 'empresario'
                                    : 'investidor';

                                $conciergeUrl = ConciergeLink::forFeaturedProperty($property, $userType);

                                $galleryRaw =
                                    $property->galleryImages
                                    ?? $property->gallery_images
                                    ?? $property->gallery
                                    ?? [];

                                $galleryUrls = collect($galleryRaw)->map(function ($img) {
                                    $path = $img->url ?? $img->path ?? null;
                                    if (!$path) return null;

                                    if (Str::startsWith($path, ['http://', 'https://'])) {
                                        return $path;
                                    }

                                    $path = ltrim($path, '/');
                                    $path = preg_replace('#^(public/)?storage/#', '', $path);

                                    return asset('storage/' . $path);
                                })->filter()->values();
                            @endphp

                            <article
                                data-featured-slide
                                @class([
                                    'group relative mx-auto w-full max-w-3xl overflow-hidden rounded-[36px] border border-white/10 bg-[#050505]/95 text-left shadow-[0_40px_120px_rgba(0,0,0,0.55)] backdrop-blur-sm transition duration-500 ease-out sm:w-[90%] md:max-w-4xl lg:mx-auto lg:w-[70%] lg:max-w-none xl:w-[60%]',
                                    'hover:-translate-y-2 hover:scale-[1.01] hover:border-lux-gold hover:shadow-[0_35px_120px_rgba(203,161,53,0.45)]' => $featuredCount > 1,
                                    'hidden opacity-0 pointer-events-none' => !$isActive,
                                    'prime-slide-enter' => $isActive,
                                ])
                                aria-hidden="{{ $isActive ? 'false' : 'true' }}"
                            >
                                <span class="absolute left-1/2 top-6 z-10 -translate-x-1/2 rounded-full bg-gradient-to-r from-[#f2d57b] via-[#f8e6a7] to-[#cba135] px-5 py-1 text-[11px] font-semibold uppercase tracking-[0.4em] text-[#1d1200] shadow-[0_12px_35px_rgba(203,161,53,0.45)]">
                                    Imovel Prime
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
                                        <p class="mt-1 text-xs uppercase tracking-[0.35em] text-white/70">
                                            {{ $property->city }} • {{ $property->state }}
                                        </p>
                                    </div>
                                </div>

                                <div class="space-y-7 p-8">
                                    <div class="flex flex-wrap gap-3 text-xs uppercase tracking-[0.25em] text-white/65">
                                        <span class="rounded-full border border-white/10 bg-[#111111] px-3 py-1 text-white">
                                            {{ Format::currency($property->price) }}
                                        </span>

                                        @if($property->area_m2)
                                            <span class="rounded-full border border-white/10 bg-[#111111] px-3 py-1 text-white/80">
                                                {{ Format::area($property->area_m2) }}
                                            </span>
                                        @endif

                                        @if($property->bedrooms)
                                            <span class="rounded-full border border-white/10 bg-[#111111] px-3 py-1 text-white/80">
                                                {{ $property->bedrooms }} quartos
                                            </span>
                                        @endif

                                        @if($property->parking_spaces)
                                            <span class="rounded-full border border-white/10 bg-[#111111] px-3 py-1 text-white/80">
                                                {{ $property->parking_spaces }} vagas
                                            </span>
                                        @endif
                                    </div>

                                    <p class="text-sm text-white/70">
                                        {{ $property->short_description ?? 'Experiencia prime com concierge dedicado e documentacao completa sob demanda.' }}
                                    </p>

                                    <div class="space-y-4 rounded-2xl border border-[#cba135]/30 bg-[#0b0b0b]/80 p-5 text-sm text-[#f5e7c2] shadow-[0_25px_80px_rgba(203,161,53,0.15)]">
                                        <p class="font-semibold uppercase tracking-[0.3em] text-[#f5d67c]">Concierge Prime</p>
                                        <p class="text-[13px] leading-relaxed text-[#f6edd5]">
                                            Investidor Prime tem atendimento e benefícios exclusivos nos Imóveis Prime.
                                            Fale com o Concierge Prime e invista no melhor do alto padrão com segurança, discrição e curadoria personalizada.
                                        </p>
                                    </div>

                                    <div class="flex justify-center">
                                        <a href="{{ $conciergeUrl }}" target="_blank" rel="noopener"
                                           class="flex w-full max-w-xs items-center justify-center gap-2 rounded-full border border-[#f0d27a]/70 bg-gradient-to-r from-[#f9e7b4] via-[#f6de95] to-[#cba135] px-5 py-3 text-xs font-semibold uppercase tracking-[0.35em] text-[#1a1202] shadow-[0_20px_60px_rgba(203,161,53,0.35)] transition duration-300 hover:scale-[1.02] hover:shadow-[0_30px_80px_rgba(203,161,53,0.45)]"
                                        >
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
                                aria-label="Imovel anterior"
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
                                aria-label="Proximo imovel"
                            >
                                <span class="hidden text-[10px] uppercase tracking-[0.45em] text-white/60 sm:inline-block">Proximo</span>
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/20 bg-gradient-to-br from-white/15 via-white/10 to-transparent text-xl font-semibold text-white transition group-hover:border-lux-gold group-hover:text-lux-gold">
                                    &rarr;
                                </span>
                            </button>
                        </div>
                    @endif
                </div>

                @if($featuredCount > 1)
                    <div data-carousel-progress class="mx-auto mt-2 w-full max-w-3xl sm:max-w-4xl lg:max-w-none lg:w-[70%] xl:w-[60%]">
                        <div class="h-[6px] w-full overflow-hidden rounded-full bg-white/10">
                            <div data-carousel-progress-bar class="prime-progress-bar h-full bg-gradient-to-r from-[#f2d57b] via-[#f8e6a7] to-[#cba135] shadow-[0_0_25px_rgba(203,161,53,0.6)]"></div>
                        </div>
                        <div class="mt-2 flex items-center justify-between text-[10px] uppercase tracking-[0.4em] text-white/40">
                            <span>Curadoria Prime</span>
                            <span data-carousel-progress-label>40s</span>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</section>

<div id="featuredPrimeModal" class="fixed inset-0 z-[12000] hidden" aria-hidden="true">
    <button type="button" data-modal-close class="absolute inset-0 bg-black/80 backdrop-blur-sm"></button>

    <div class="relative mx-auto mt-6 w-[88%] max-w-4xl sm:mt-10 prime-modal-enter">
        <div class="relative max-h-[72vh] overflow-hidden rounded-[32px] border border-white/10 bg-[#050505] shadow-[0_40px_120px_rgba(0,0,0,0.7)]">
            <div class="flex items-center justify-between border-b border-white/10 bg-black/40 px-6 py-5">
                <div class="flex items-center gap-3">
                    <span class="rounded-full bg-gradient-to-r from-[#f2d57b] via-[#f8e6a7] to-[#cba135] px-4 py-1 text-[10px] font-semibold uppercase tracking-[0.45em] text-[#1d1200]">
                        Imovel Prime
                    </span>
                    <span data-modal-status class="text-[10px] uppercase tracking-[0.4em] text-white/70">DISPONIVEL</span>
                </div>

                <button type="button" data-modal-close
                        class="group inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/15 bg-black/50 text-white/70 transition hover:border-[#cba135] hover:text-white"
                        aria-label="Fechar modal"
                >
                    ✕
                </button>
            </div>

            <div class="relative bg-black">
                <div class="relative aspect-[16/9] w-full overflow-hidden" id="modalMedia">
                    <img id="modalHero" class="h-full w-full max-h-[45vh] object-cover cursor-zoom-in" alt="Imovel Prime">

                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-black/10 via-transparent to-black/80"></div>

                    <div class="absolute bottom-5 left-5 right-5">
                        <h3 data-modal-title class="font-poppins text-2xl font-semibold text-white sm:text-3xl"></h3>
                        <p data-modal-location class="mt-1 text-xs uppercase tracking-[0.35em] text-white/70"></p>
                    </div>
                </div>

                <div class="flex items-center gap-3 border-t border-white/10 bg-[#070707] px-4 py-3">
                    <button type="button" data-thumbs-prev
                            class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/10 bg-black/40 text-white/70 transition hover:border-[#cba135]/70 hover:text-white"
                            aria-label="Anterior"
                    >&larr;</button>

                    <div id="modalThumbs" class="flex flex-1 gap-3 overflow-x-auto py-1 scrollbar-thin scrollbar-thumb-white/10"></div>

                    <button type="button" data-thumbs-next
                            class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/10 bg-black/40 text-white/70 transition hover:border-[#cba135]/70 hover:text-white"
                            aria-label="Proximo"
                    >&rarr;</button>
                </div>
            </div>

            <div class="space-y-6 p-7 sm:p-9">
                <div class="flex flex-wrap items-center gap-3">
                    <span data-modal-price
                          class="rounded-full border border-white/10 bg-[#111111] px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-white"></span>
                    <div data-modal-chips class="flex flex-wrap gap-2"></div>
                </div>

                <p data-modal-description class="text-sm leading-relaxed text-white/75"></p>

                <div class="space-y-3 rounded-2xl border border-[#cba135]/30 bg-[#0b0b0b]/80 p-5 text-sm text-[#f5e7c2] shadow-[0_25px_80px_rgba(203,161,53,0.15)]">
                    <p class="font-semibold uppercase tracking-[0.3em] text-[#f5d67c]">Concierge Prime</p>
                    <p class="text-[13px] leading-relaxed text-[#f6edd5]">
                        Atendimento dedicado, dossie completo e mediacao direta com o Master.
                        Clique abaixo para falar com o Concierge Prime.
                    </p>
                </div>

                <div class="grid gap-3 text-center sm:grid-cols-2">
                    <a data-modal-concierge-btn href="#" target="_blank" rel="noopener"
                       class="flex items-center justify-center gap-2 rounded-full border border-[#f0d27a]/70 bg-gradient-to-r from-[#f9e7b4] via-[#f6de95] to-[#cba135] px-4 py-3 text-xs font-semibold uppercase tracking-[0.35em] text-[#1a1202] shadow-[0_20px_60px_rgba(203,161,53,0.35)] transition duration-300 hover:scale-[1.02] hover:shadow-[0_30px_80px_rgba(203,161,53,0.45)]"
                    >
                        <span class="text-base">✶</span>
                        Falar com o Concierge Prime
                    </a>

                    <button type="button" data-modal-close
                            class="flex items-center justify-center rounded-full border border-white/15 bg-black/40 px-4 py-3 text-xs font-semibold uppercase tracking-[0.3em] text-white/80 transition hover:border-white/30 hover:text-white">
                        Voltar a vitrine
                    </button>
                </div>
            </div>

            <div class="sm:hidden sticky bottom-0 border-t border-white/10 bg-black/80 backdrop-blur-md px-4 py-3">
                <a data-modal-concierge-sticky href="#" target="_blank" rel="noopener"
                   class="flex w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-[#f9e7b4] via-[#f6de95] to-[#cba135] px-4 py-3 text-xs font-semibold uppercase tracking-[0.35em] text-[#1a1202] shadow-[0_14px_40px_rgba(203,161,53,0.45)]"
                >
                    ✶ Falar com Concierge Prime
                </a>
            </div>
        </div>
    </div>
</div>

<div id="primeLightbox" class="fixed inset-0 z-[10000] hidden" aria-hidden="true">
    <button type="button" data-lightbox-close class="absolute inset-0 bg-black/90 backdrop-blur-sm"></button>

    <div class="relative mx-auto flex h-full w-full max-w-6xl items-center justify-center px-4">
        <div class="relative w-full overflow-hidden rounded-[24px] border border-white/10 bg-black shadow-[0_40px_120px_rgba(0,0,0,0.8)]">
            <video id="lightboxVideo" class="hidden w-full max-h-[90vh] object-contain" controls playsinline></video>
            <img id="lightboxImg" class="hidden w-full max-h-[90vh] object-contain" alt="Foto Prime">

            <button type="button" data-lightbox-prev
                    class="absolute left-3 top-1/2 -translate-y-1/2 rounded-full border border-white/20 bg-black/60 px-4 py-3 text-white/80 backdrop-blur-sm transition hover:border-[#cba135]/70 hover:text-white"
                    aria-label="Anterior">
                &larr;
            </button>

            <button type="button" data-lightbox-next
                    class="absolute right-3 top-1/2 -translate-y-1/2 rounded-full border border-white/20 bg-black/60 px-4 py-3 text-white/80 backdrop-blur-sm transition hover:border-[#cba135]/70 hover:text-white"
                    aria-label="Proximo">
                &rarr;
            </button>

            <button type="button" data-lightbox-close
                class="absolute right-3 top-3 rounded-full border border-white/20 bg-black/70 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white/80 backdrop-blur-sm transition hover:border-[#cba135]/70 hover:text-white">
                Fechar
            </button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (() => {
            if (window.__primeFeaturedModalInline) return;
            window.__primeFeaturedModalInline = true;

            const modal = document.getElementById('featuredPrimeModal');
            if (!modal) return;

            const els = {
                title: modal.querySelector('[data-modal-title]'),
                location: modal.querySelector('[data-modal-location]'),
                status: modal.querySelector('[data-modal-status]'),
                price: modal.querySelector('[data-modal-price]'),
                chips: modal.querySelector('[data-modal-chips]'),
                description: modal.querySelector('[data-modal-description]'),
                conciergeBtn: modal.querySelector('[data-modal-concierge-btn]'),
                conciergeSticky: modal.querySelector('[data-modal-concierge-sticky]'),
                video: null,
                hero: modal.querySelector('#modalHero'),
                thumbs: modal.querySelector('#modalThumbs'),
                thumbPrev: modal.querySelector('[data-thumbs-prev]'),
                thumbNext: modal.querySelector('[data-thumbs-next]'),
                closeBtns: modal.querySelectorAll('[data-modal-close]'),
            };

            let gallery = [];
            let currentIndex = 0;
            let hasVideo = false;
            let videoUrl = '';

            const setActive = (key) => {
                Array.from(els.thumbs?.children || []).forEach((btn) => {
                    btn.classList.remove('ring-2', 'ring-[#cba135]');
                    btn.setAttribute('aria-current', 'false');
                });
                const selector = key === 'video' ? '[data-thumb-video]' : `[data-thumb-index="${key}"]`;
                const target = els.thumbs?.querySelector(selector);
                if (target) {
                    target.classList.add('ring-2', 'ring-[#cba135]');
                    target.setAttribute('aria-current', 'true');
                }
            };

            const showImage = (idx) => {
                currentIndex = idx;
                const src = gallery[idx];
                if (!src) return;
                if (els.video) {
                    els.video.pause();
                    els.video.classList.add('hidden');
                }
                if (els.hero) {
                    els.hero.src = src;
                    els.hero.classList.remove('hidden');
                }
                setActive(idx);
            };

            const showVideo = () => {
                if (!hasVideo || !els.video) return;
                if (els.hero) els.hero.classList.add('hidden');
                els.video.classList.remove('hidden');
                els.video.src = videoUrl;
                els.video.load();
                els.video.play().catch(() => {});
                setActive('video');
            };

            const buildThumbs = () => {
                if (!els.thumbs) return;
                els.thumbs.innerHTML = '';

                if (hasVideo) {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.dataset.thumbVideo = '1';
                    btn.className = 'relative h-20 w-28 flex-shrink-0 overflow-hidden rounded-xl border border-white/10 bg-black/60 transition hover:border-[#cba135]/70 focus:outline-none focus:ring-2 focus:ring-[#cba135]';
                    btn.innerHTML = '<div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-black via-[#0b0b0b] to-black"><span class="text-[10px] uppercase tracking-[0.35em] text-white/80">Vídeo</span></div>';
                    btn.addEventListener('click', showVideo);
                    els.thumbs.appendChild(btn);
                }

                gallery.forEach((src, idx) => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.dataset.thumbIndex = String(idx);
                    btn.className = 'relative h-20 w-28 flex-shrink-0 overflow-hidden rounded-xl border border-white/10 bg-black/40 transition hover:border-[#cba135]/70 focus:outline-none focus:ring-2 focus:ring-[#cba135]';
                    btn.innerHTML = `<img src="${src}" class="h-full w-full object-cover" alt="Foto ${idx + 1}">`;
                    btn.addEventListener('click', () => showImage(idx));
                    els.thumbs.appendChild(btn);
                });
            };

            const openModal = (data) => {
                const galleryData = (() => {
                    try {
                        return data.gallery ? JSON.parse(data.gallery) : [];
                    } catch {
                        return [];
                    }
                })();

                gallery = Array.isArray(galleryData) ? galleryData.filter(Boolean) : [];
                if (data.hero) gallery = [data.hero, ...gallery];

                hasVideo = false;
                videoUrl = '';

                els.title && (els.title.textContent = data.title || 'Imóvel Prime');
                els.location && (els.location.textContent = [data.city, data.state].filter(Boolean).join(' • '));
                els.status && (els.status.textContent = data.status || 'DISPONÍVEL');
                els.price && (els.price.textContent = data.price || '');

                if (els.chips) {
                    const chips = [];
                    if (data.area) chips.push(data.area);
                    if (data.bedrooms) chips.push(`${data.bedrooms} quartos`);
                    if (data.parking) chips.push(`${data.parking} vagas`);
                    els.chips.innerHTML = chips.map((t) => `<span class="rounded-full border border-white/10 bg-[#111111] px-3 py-1 text-xs uppercase tracking-[0.25em] text-white/90">${t}</span>`).join('');
                }

                els.description && (els.description.textContent = data.description || 'Experiência prime com concierge dedicado e documentação completa sob demanda.');
                if (els.conciergeBtn) els.conciergeBtn.href = data.concierge || '#';
                if (els.conciergeSticky) els.conciergeSticky.href = data.concierge || '#';

                buildThumbs();
                showImage(0);

                modal.classList.remove('hidden');
                modal.setAttribute('aria-hidden', 'false');
                document.documentElement.classList.add('overflow-hidden');
            };

            const closeModal = () => {
                modal.classList.add('hidden');
                modal.setAttribute('aria-hidden', 'true');
                document.documentElement.classList.remove('overflow-hidden');
                // nada para pausar, pois removemos o vídeo do modal
            };

            document.querySelectorAll('[data-featured-open-modal]').forEach((btn) => {
                btn.addEventListener('click', () => openModal(btn.dataset));
            });

            els.closeBtns?.forEach((btn) => btn.addEventListener('click', closeModal));
            modal.addEventListener('click', (evt) => {
                if (evt.target === modal) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.getAttribute('aria-hidden') === 'false') closeModal();
            });

            els.thumbPrev?.addEventListener('click', () => {
                if (!gallery.length) return;
                currentIndex = (currentIndex - 1 + gallery.length) % gallery.length;
                showImage(currentIndex);
            });

            els.thumbNext?.addEventListener('click', () => {
                if (!gallery.length) return;
                currentIndex = (currentIndex + 1) % gallery.length;
                showImage(currentIndex);
            });
        })();
    </script>
@endpush
