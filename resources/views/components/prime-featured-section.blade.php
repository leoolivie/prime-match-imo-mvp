@props([
    'featured' => collect(),
    'title' => 'Imóveis em destaque',
    'subtitle' => 'Seleção exclusiva curada pelo Master para impactar investidores.',
])

@php
    use App\Support\Format;
@endphp

<section class="relative overflow-hidden bg-[#040404] py-16 sm:py-20">
    <div class="absolute inset-0 bg-gradient-to-br from-[#111111] via-[#050505] to-[#0f0f0f]"></div>
    <div class="absolute inset-0 opacity-40" style="background: radial-gradient(circle at top left, rgba(212,175,55,0.25), transparent 55%), radial-gradient(circle at bottom right, rgba(0,0,0,0.65), transparent 60%);"></div>
    <div class="relative lux-container space-y-10">
        <div class="flex flex-col items-center gap-6 text-center">
            <div class="space-y-4 max-w-4xl">
                <span class="lux-badge-gold">Coleção prime</span>
                <h2 class="font-poppins text-4xl font-semibold text-white sm:text-5xl">{{ $title }}</h2>
                <p class="max-w-3xl text-sm text-white/60 sm:text-base">{{ $subtitle }}</p>
            </div>
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
            <div class="-mx-4 overflow-x-auto px-4">
                <div class="flex snap-x snap-mandatory justify-center gap-6 pb-6 md:grid md:grid-cols-3 md:gap-8 md:pb-0 md:justify-items-center">
                    @foreach($featured as $property)
                        <article class="group relative shrink-0 snap-start overflow-hidden rounded-[32px] border border-white/10 bg-[#090909] transition hover:border-lux-gold/60 hover:shadow-[0_25px_60px_rgba(0,0,0,0.45)] sm:w-[22rem] md:w-[26rem] lg:w-[32rem]">
                            <div class="relative h-80 overflow-hidden">
                                <img src="{{ $property->hero_image_url }}" alt="{{ $property->title }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-transparent to-black/60"></div>
                                <div class="absolute left-5 top-5 flex items-center gap-2 rounded-full border border-white/20 bg-black/50 px-3 py-1 text-xs uppercase tracking-[0.35em] text-white">
                                    <span>{{ strtoupper($property->status ?? 'disponível') }}</span>
                                </div>
                                <div class="absolute bottom-5 left-5 right-5">
                                    <h3 class="font-poppins text-2xl font-semibold text-white">{{ $property->title }}</h3>
                                    <p class="mt-1 text-xs uppercase tracking-[0.35em] text-white/70">{{ $property->city }} • {{ $property->state }}</p>
                                </div>
                            </div>
                            <div class="space-y-6 p-6">
                                <div class="flex flex-wrap gap-3 text-xs uppercase tracking-[0.2em] text-white/60">
                                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-white">{{ Format::currency($property->price) }}</span>
                                    @if($property->area_m2)
                                        <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-white/80">{{ Format::area($property->area_m2) }}</span>
                                    @endif
                                    @if($property->bedrooms)
                                        <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-white/80">{{ $property->bedrooms }} quartos</span>
                                    @endif
                                    @if($property->parking_spaces)
                                        <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-white/80">{{ $property->parking_spaces }} vagas</span>
                                    @endif
                                </div>
                                <p class="text-sm text-white/70">{{ $property->short_description ?? 'Experiência prime com concierge dedicado e documentação completa sob demanda.' }}</p>
                                <div class="grid gap-3 sm:grid-cols-2">
                                    <a href="{{ $property->cta_view_url ?? route('investor.catalog') }}" class="flex items-center justify-center rounded-full border border-white/20 px-4 py-3 text-xs uppercase tracking-[0.3em] text-white transition hover:border-lux-gold hover:text-white">Ver imóvel</a>
                                    <a href="{{ $property->cta_concierge_url ?? route('concierge.redirect') }}" target="_blank" rel="noopener" class="flex items-center justify-center rounded-full bg-lux-gold px-4 py-3 text-xs font-semibold uppercase tracking-[0.3em] text-lux-black shadow-lux-glow transition hover:bg-[#f0d27a]">Falar com o concierge</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
