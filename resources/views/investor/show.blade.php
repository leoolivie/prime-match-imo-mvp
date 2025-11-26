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


{{-- Main Content Section --}}
<section class="bg-[#050505] pb-16 pt-10 sm:pt-14">
    <div class="lux-container space-y-10">
        {{-- Hero Image + Details Grid --}}
        <div class="grid gap-8 lg:grid-cols-[1.3fr_0.7fr]">
            {{-- Hero Image/Video --}}
            <div class="overflow-hidden rounded-[24px] border border-white/10 bg-black/70">
                <div class="relative h-[350px] sm:h-[450px] overflow-hidden">
                    @if($heroVideo)
                        <video class="h-full w-full object-cover" autoplay muted loop playsinline controls>
                            <source src="{{ $heroVideo }}" type="video/mp4">
                        </video>
                    @else
                        <button type="button" class="group h-full w-full cursor-zoom-in" data-zoom-src="{{ $heroImage }}">
                            <img src="{{ $heroImage }}" alt="{{ $property->title }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.02] group-hover:brightness-110">
                        </button>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                    <div class="absolute left-4 top-4 flex gap-2">
                        <span class="rounded-full bg-white/15 px-3 py-1 text-[11px] uppercase tracking-[0.3em] text-white font-semibold">{{ ucfirst($property->type) }}</span>
                        <span class="rounded-full bg-white/10 px-3 py-1 text-[11px] uppercase tracking-[0.3em] text-white/80">{{ $property->city }} • {{ $property->state }}</span>
                    </div>
                </div>
            </div>

            {{-- Right Column: Key Info --}}
            <div class="space-y-6">
                {{-- Title & Location --}}
                <div class="space-y-3">
                    <div class="inline-block">
                        <span class="px-3 py-1 rounded-full bg-yellow-400/20 border border-yellow-400/40 text-xs uppercase tracking-[0.3em] text-yellow-300 font-semibold">Ativo Prime</span>
                    </div>
                    <h1 class="font-poppins text-3xl font-bold text-white leading-tight">{{ $property->title }}</h1>
                    <p class="text-sm uppercase tracking-[0.35em] text-yellow-300/70 font-semibold">{{ $property->city }} • {{ $property->state }}</p>
                </div>

                {{-- Key Metrics --}}
                <div class="space-y-3 border-t border-white/10 pt-6">
                    <div class="flex items-end justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-white/60 font-semibold">Valor</p>
                            <p class="mt-2 text-3xl font-bold text-yellow-300">{{ Format::currency($property->price) }}</p>
                        </div>
                    </div>
                    <div class="flex items-end justify-between gap-4 border-t border-white/10 pt-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-white/60 font-semibold">Status</p>
                            <p class="mt-2 text-lg font-semibold text-white">{{ $property->status_label }}</p>
                        </div>
                    </div>
                </div>

                {{-- Specs Grid --}}
                <div class="space-y-3 border-t border-white/10 pt-6">
                    @if($property->area)
                        <div class="flex items-center justify-between">
                            <p class="text-xs uppercase tracking-[0.2em] text-white/60">Área</p>
                            <p class="text-lg font-semibold text-white">{{ Format::area($property->area) }}</p>
                        </div>
                    @endif
                    @if($property->bedrooms)
                        <div class="flex items-center justify-between">
                            <p class="text-xs uppercase tracking-[0.2em] text-white/60">Quartos</p>
                            <p class="text-lg font-semibold text-white">{{ $property->bedrooms }}</p>
                        </div>
                    @endif
                    @if($property->bathrooms)
                        <div class="flex items-center justify-between">
                            <p class="text-xs uppercase tracking-[0.2em] text-white/60">Suítes</p>
                            <p class="text-lg font-semibold text-white">{{ $property->bathrooms }}</p>
                        </div>
                    @endif
                    @if($property->features['vagas'] ?? false)
                        <div class="flex items-center justify-between">
                            <p class="text-xs uppercase tracking-[0.2em] text-white/60">Vagas</p>
                            <p class="text-lg font-semibold text-white">{{ $property->features['vagas'] }}</p>
                        </div>
                    @endif
                </div>

                {{-- CTA Button --}}
                <div class="pt-6 border-t border-white/10">
                    <a href="{{ $conciergeUrl }}" target="_blank" rel="noopener" class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-black font-bold uppercase tracking-[0.3em] text-xs py-4 hover:shadow-[0_0_30px_rgba(245,158,11,0.4)] transition-all duration-300">
                        <i class="fas fa-whatsapp"></i>Falar com Concierge
                    </a>
                </div>
            </div>
        </div>

        {{-- Description Section --}}
        <div class="rounded-[20px] border border-yellow-400/20 bg-gradient-to-br from-yellow-400/10 to-transparent backdrop-blur-xl p-8 space-y-6">
            <div class="space-y-3">
                <h2 class="text-2xl font-bold text-white">Sobre o Ativo</h2>
                <p class="text-base text-white/70 leading-relaxed">{{ $property->description }}</p>
            </div>

            @if($amenities->count())
                <div class="space-y-4 border-t border-yellow-400/20 pt-6">
                    <p class="text-sm uppercase tracking-[0.3em] text-yellow-300/70 font-semibold">Amenidades</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($amenities as $amenity)
                            <span class="px-3 py-1 rounded-full border border-yellow-400/30 bg-yellow-400/10 text-xs uppercase tracking-[0.2em] text-yellow-300 font-semibold">{{ $amenity }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="border-t border-yellow-400/20 pt-6">
                <p class="text-xs text-white/60 italic">Fale com o concierge para receber vídeo completo, ficha técnica detalhada e agenda de visita exclusiva.</p>
            </div>
        </div>

        {{-- Gallery Section --}}
        @if($gallery->count())
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Galeria de Imagens</h2>
                    <span class="text-xs uppercase tracking-[0.3em] text-white/50 font-semibold">{{ $gallery->count() }} mídia(s)</span>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($gallery as $image)
                        @php
                            $url = $property->mediaUrl($image->path) ?? $asset('images/placeholders/luxury-property.svg');
                        @endphp
                        <div class="overflow-hidden rounded-[16px] border border-white/10 bg-black/40 group cursor-zoom-in">
                            <button type="button" class="block h-full w-full" data-zoom-src="{{ $url }}">
                                <img src="{{ $url }}" alt="Imagem {{ $loop->iteration }}" class="h-56 w-full object-cover transition duration-300 group-hover:scale-[1.05] group-hover:brightness-110">
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Back Button --}}
        <div class="flex justify-center pt-6">
            <a href="{{ route('investor.catalog') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-full border border-white/20 hover:border-yellow-400/40 text-white hover:text-yellow-300 uppercase tracking-[0.3em] text-xs font-semibold transition-all duration-300">
                <i class="fas fa-arrow-left"></i>Voltar ao Catálogo
            </a>
        </div>
    </div>
</section>

{{-- Fixed Bottom CTA Bar --}}
<div class="fixed inset-x-0 bottom-0 z-40 border-t border-white/10 bg-[#0B0B0B]/95 backdrop-blur-xl">
    <div class="lux-container flex flex-col gap-4 py-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-yellow-500 text-white font-bold">
                <i class="fas fa-star text-sm"></i>
            </div>
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-white/60 font-semibold">Concierge Disponível 24/7</p>
                <p class="text-sm font-semibold text-white">Tire suas dúvidas sobre este ativo</p>
            </div>
        </div>
        <a href="{{ $conciergeUrl }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-black font-bold uppercase tracking-[0.3em] text-xs px-8 py-3 hover:shadow-[0_0_20px_rgba(245,158,11,0.4)] transition-all duration-300 whitespace-nowrap">
            <i class="fas fa-whatsapp"></i>Falar Agora
        </a>
    </div>
</div>

{{-- Image Zoom Modal --}}
<div id="zoomModal" class="fixed inset-0 z-[120] hidden flex items-center justify-center bg-black/90 p-4 backdrop-blur-sm" role="dialog" aria-modal="true">
    <div class="relative w-full max-w-4xl max-h-[90vh] flex flex-col">
        {{-- Close Button --}}
        <button 
            type="button" 
            id="zoomClose" 
            class="absolute -top-12 right-0 rounded-full bg-white/10 hover:bg-white/20 px-4 py-2 text-xs uppercase tracking-[0.25em] text-white transition-all duration-300 z-50"
            aria-label="Fechar visualização"
        >
            <i class="fas fa-times mr-2"></i>Fechar
        </button>
        
        {{-- Image Container --}}
        <div class="flex-1 flex items-center justify-center overflow-hidden rounded-[16px] border border-white/20 bg-black">
            <img 
                id="zoomImage" 
                src="" 
                alt="Visualização ampliada" 
                class="max-h-[85vh] max-w-full object-contain"
            >
        </div>

        {{-- Image Counter --}}
        <div class="mt-4 text-center">
            <p class="text-sm text-white/70">
                <span id="imageCounter">1</span> / <span id="imageTotalCounter">1</span>
            </p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('zoomModal');
        const imgEl = document.getElementById('zoomImage');
        const closeBtn = document.getElementById('zoomClose');
        const counter = document.getElementById('imageCounter');
        const totalCounter = document.getElementById('imageTotalCounter');
        
        let currentImageIndex = 0;
        let allImages = [];

        function initializeZoom() {
            allImages = Array.from(document.querySelectorAll('[data-zoom-src]'));
            totalCounter.textContent = allImages.length;
        }

        function openZoom(src) {
            if (!src) return;
            
            currentImageIndex = allImages.findIndex(img => img.getAttribute('data-zoom-src') === src);
            if (currentImageIndex === -1) currentImageIndex = 0;
            
            imgEl.src = src;
            counter.textContent = currentImageIndex + 1;
            modal.classList.remove('hidden');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeZoom() {
            modal.classList.add('hidden');
            modal.style.display = 'none';
            imgEl.src = '';
            document.body.style.overflow = 'auto';
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % allImages.length;
            const src = allImages[currentImageIndex].getAttribute('data-zoom-src');
            imgEl.src = src;
            counter.textContent = currentImageIndex + 1;
        }

        function prevImage() {
            currentImageIndex = (currentImageIndex - 1 + allImages.length) % allImages.length;
            const src = allImages[currentImageIndex].getAttribute('data-zoom-src');
            imgEl.src = src;
            counter.textContent = currentImageIndex + 1;
        }

        // Initialize
        initializeZoom();

        // Event Listeners
        document.querySelectorAll('[data-zoom-src]').forEach(btn => {
            btn.addEventListener('click', () => {
                openZoom(btn.getAttribute('data-zoom-src'));
            });
        });

        closeBtn.addEventListener('click', closeZoom);

        // Close on background click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeZoom();
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (modal.classList.contains('hidden')) return;
            
            if (e.key === 'Escape') closeZoom();
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') prevImage();
        });
    });
</script>
@endpush
