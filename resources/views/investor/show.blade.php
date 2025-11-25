@extends('layouts.app')

@section('title', $property->title . ' - Prime Match Imo')

@section('content')
@php
    use App\Support\Format;
    use App\Support\ConciergeLink;

    $asset = fn(string $path) => app()->environment(['local', 'testing']) ? asset($path) : asset('public/' . ltrim($path, '/'));

    $heroVideo = $property->video_url;
    $primaryPath = optional($property->primaryImage)->path;
    $heroImage = $property->mediaUrl($primaryPath) ?? $asset('images/placeholders/luxury-property.svg');
    $conciergeUrl = ConciergeLink::forInvestorCard($property);
@endphp

<section class="bg-[#050505] pb-16 pt-10 sm:pt-14">
    <div class="lux-container space-y-10">
        <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="overflow-hidden rounded-[32px] border border-white/10 bg-black/70 shadow-[0_30px_100px_rgba(0,0,0,0.45)]">
                <div class="relative h-[380px] overflow-hidden sm:h-[480px]">
                    @if($heroVideo)
                        <video class="h-full w-full object-cover" autoplay muted loop playsinline controls>
                            <source src="{{ $heroVideo }}" type="video/mp4">
                        </video>
                    @else
                        <button type="button" class="group h-full w-full" data-zoom-src="{{ $heroImage }}">
                            <img src="{{ $heroImage }}" alt="{{ $property->title }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.02] group-hover:brightness-105">
                        </button>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                    <div class="absolute left-5 top-5 flex gap-2">
                        <span class="rounded-full bg-white/15 px-3 py-1 text-[11px] uppercase tracking-[0.3em] text-white">{{ ucfirst($property->type) }}</span>
                        <span class="rounded-full bg-white/10 px-3 py-1 text-[11px] uppercase tracking-[0.3em] text-white/80">{{ $property->city }} • {{ $property->state }}</span>
                    </div>
                </div>
            </div>

            <div class="space-y-6 rounded-[32px] border border-white/10 bg-white/5 p-8 shadow-[0_25px_80px_rgba(0,0,0,0.35)]">
                <div class="space-y-2">
                    <span class="lux-badge-gold">Imóvel prime</span>
                    <h1 class="font-poppins text-3xl font-semibold text-white">{{ $property->title }}</h1>
                    <p class="text-sm uppercase tracking-[0.3em] text-white/60">{{ $property->city }} • {{ $property->state }}</p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-white/10 bg-black/40 p-4">
                        <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Valor</p>
                        <p class="mt-1 text-2xl font-semibold text-white">{{ Format::currency($property->price) }}</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-black/40 p-4">
                        <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Status</p>
                        <p class="mt-1 text-lg font-semibold text-white">{{ $property->status_label }}</p>
                    </div>
                    @if($property->area)
                        <div class="rounded-2xl border border-white/10 bg-black/40 p-4">
                            <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Área</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ Format::area($property->area) }}</p>
                        </div>
                    @endif
                    @if($property->bedrooms)
                        <div class="rounded-2xl border border-white/10 bg-black/40 p-4">
                            <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Quartos</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ $property->bedrooms }}</p>
                        </div>
                    @endif
                    @if($property->bathrooms)
                        <div class="rounded-2xl border border-white/10 bg-black/40 p-4">
                            <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Suítes</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ $property->bathrooms }}</p>
                        </div>
                    @endif
                    @if($property->features['vagas'] ?? false)
                        <div class="rounded-2xl border border-white/10 bg-black/40 p-4">
                            <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Vagas</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ $property->features['vagas'] }}</p>
                        </div>
                    @endif
                </div>

                <div class="rounded-2xl border border-lux-gold/30 bg-white/5 p-5 text-sm text-white/80 shadow-[0_20px_60px_rgba(203,161,53,0.08)]">
                    <div class="flex items-center gap-3">
                        <div class="rounded-full bg-gradient-to-r from-[#f3d98b] to-[#b88a2a] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.35em] text-[#1c1304] shadow-[0_0_20px_rgba(203,161,53,0.35)]">Prime</div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Descrição Prime</p>
                            <p class="text-lg font-semibold text-white">Encante-se antes da visita</p>
                        </div>
                    </div>
                    <div class="mt-4 space-y-3 border-t border-white/10 pt-4 leading-relaxed">
                        <p class="text-white/80">{{ $property->description }}</p>
                        <div class="rounded-xl border border-white/15 bg-black/30 p-3 text-xs uppercase tracking-[0.3em] text-white/60">
                            Fale com o concierge para receber vídeo, ficha técnica e agenda de visita exclusiva.
                        </div>
                    </div>
                </div>

                @if($amenities->count())
                    <div class="space-y-3">
                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Amenidades</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($amenities as $amenity)
                                <span class="lux-badge-outline">{{ $amenity }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="flex flex-wrap gap-3">
                    <a href="{{ $conciergeUrl }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com o concierge</a>
                    <a href="{{ route('investor.catalog') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Voltar ao catálogo</a>
                </div>
            </div>
        </div>

        @if($gallery->count())
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Galeria</h2>
                    <span class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $gallery->count() }} mídia(s)</span>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($gallery as $image)
                        @php
                            $url = $property->mediaUrl($image->path) ?? $asset('images/placeholders/luxury-property.svg');
                        @endphp
                        <div class="overflow-hidden rounded-2xl border border-white/10 bg-black/40">
                            <button type="button" class="group block h-full w-full" data-zoom-src="{{ $url }}">
                                <img src="{{ $url }}" alt="Imagem {{ $loop->iteration }}" class="h-56 w-full object-cover transition duration-200 group-hover:scale-[1.02] group-hover:brightness-105">
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

<div class="fixed inset-x-0 bottom-0 z-50 border-t border-white/10 bg-[#0B0B0B]/90 backdrop-blur-xl">
    <div class="lux-container flex flex-col gap-4 py-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <span class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-2xl border border-lux-gold/50 bg-white/5 shadow-[0_0_25px_rgba(203,161,53,0.4)]">
                <img src="{{ $asset('images/placeholders/luxury-property.svg') }}" alt="Prime Match Imo" class="h-10 w-10 object-contain" loading="lazy">
            </span>
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-white/50">Concierge único disponível</p>
                <p class="text-lg font-semibold text-white">Fale agora com o concierge para avançar neste imóvel</p>
            </div>
        </div>
        <a href="{{ $conciergeUrl }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com o concierge</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 z-[120] hidden items-center justify-center bg-black/80 p-4 backdrop-blur';
        modal.innerHTML = `
            <div class="relative max-h-[90vh] w-full max-w-5xl overflow-hidden rounded-2xl border border-white/15 bg-black shadow-2xl">
                <button type="button" data-zoom-close class="absolute right-3 top-3 rounded-full bg-white/10 px-3 py-1 text-xs uppercase tracking-[0.25em] text-white hover:bg-white/20">Fechar</button>
                <img data-zoom-image src="" alt="Visualização" class="max-h-[86vh] w-full object-contain bg-black">
            </div>
        `;
        document.body.appendChild(modal);

        const imgEl = modal.querySelector('[data-zoom-image]');
        const closeBtn = modal.querySelector('[data-zoom-close]');

        function openZoom(src) {
            if (!src) return;
            imgEl.src = src;
            modal.classList.remove('hidden');
        }

        function closeZoom() {
            modal.classList.add('hidden');
            imgEl.src = '';
        }

        document.querySelectorAll('[data-zoom-src]').forEach(btn => {
            btn.addEventListener('click', () => openZoom(btn.getAttribute('data-zoom-src')));
        });

        closeBtn.addEventListener('click', closeZoom);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeZoom();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeZoom();
        });
    });
</script>
@endpush
