@extends('layouts.app')

@section('title', $property->title . ' · Prime Match Imo')

@section('content')
@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
    use Illuminate\Support\Facades\Storage;

    $whatsappUrl = ConciergeLink::forInvestorDetail($property);
    $galleryImages = $gallery
        ->map(function ($image) {
            return $image->path ? Storage::disk('public')->url($image->path) : null;
        })
        ->filter()
        ->values();
@endphp

<div class="pb-24 pt-10">
    <div class="lux-container space-y-10">
        <nav class="text-xs uppercase tracking-[0.35em] text-white/50">
            <a href="{{ route('investor.catalog') }}" class="hover:text-white">Vitrine prime</a>
            <span class="mx-2">/</span>
            <span class="text-white">{{ $property->title }}</span>
        </nav>

        @if(!empty($isPreview))
            <div class="rounded-2xl border border-lux-gold/40 bg-lux-gold/10 px-5 py-3 text-sm text-white/80">
                Pré-visualização privada — somente você e o concierge conseguem acessar este link.
            </div>
        @endif

        <header class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
            <div class="space-y-4">
                <span class="lux-badge-gold">Imóvel prime</span>
                <h1 class="font-poppins text-4xl font-semibold text-white sm:text-5xl">{{ $property->title }}</h1>
                <p class="text-sm uppercase tracking-[0.35em] text-white/60">{{ $property->city }} • {{ $property->state }}</p>
                <div class="flex flex-wrap gap-3 text-sm text-white/70">
                    <span class="badge-outline">{{ Format::currency($property->price) }}</span>
                    @if($property->area)
                        <span class="badge-outline">{{ Format::area($property->area) }}</span>
                    @endif
                    @if($property->bedrooms)
                        <span class="badge-outline">{{ $property->bedrooms }} quartos</span>
                    @endif
                    @if($property->bathrooms)
                        <span class="badge-outline">{{ $property->bathrooms }} suítes</span>
                    @endif
                </div>
            </div>
            <div class="flex flex-col gap-3 rounded-3xl border border-white/10 bg-white/5 p-6 text-sm text-white/70">
                <div class="flex items-center justify-between">
                    <span>Visitas (7 dias)</span>
                    <strong class="text-white">{{ number_format($metrics['views7']) }}</strong>
                </div>
                <div class="flex items-center justify-between">
                    <span>Visitas (30 dias)</span>
                    <strong class="text-white">{{ number_format($metrics['views30']) }}</strong>
                </div>
                <div class="flex items-center justify-between">
                    <span>Cliques concierge</span>
                    <strong class="text-white">{{ number_format($metrics['clicks']) }}</strong>
                </div>
                <div class="flex items-center justify-between">
                    <span>Conversão</span>
                    @php
                        $conversion = $metrics['views30'] > 0 ? round(($metrics['clicks'] / max($metrics['views30'], 1)) * 100, 1) : 0;
                    @endphp
                    <strong class="text-white">{{ number_format($conversion, 1) }}%</strong>
                </div>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com o concierge</a>
            </div>
        </header>

        <section class="space-y-6">
            <div class="overflow-hidden rounded-3xl border border-white/10 bg-[#0B0B0B]">
                <div class="relative">
                    <div class="flex gap-4 overflow-x-auto p-4">
                        @forelse($galleryImages as $src)
                            <div class="h-72 w-[380px] flex-shrink-0 overflow-hidden rounded-2xl border border-white/10 bg-[#111]">
                                <img src="{{ $src }}" alt="Foto do imóvel {{ $property->title }}" class="h-full w-full object-cover" loading="lazy" />
                            </div>
                        @empty
                            <div class="h-72 w-full overflow-hidden rounded-2xl border border-white/10 bg-[#111]">
                                <img src="{{ asset('images/placeholders/luxury-property.svg') }}" alt="Placeholder" class="h-full w-full object-cover" />
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <article class="lux-card-dark space-y-6">
                <div class="space-y-3">
                    <h2 class="text-2xl font-semibold text-white">Descrição</h2>
                    <p class="text-sm leading-relaxed text-white/70">{!! nl2br(e($property->description)) !!}</p>
                </div>
                <div class="space-y-3">
                    <h3 class="text-xl font-semibold text-white">Amenidades</h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse($amenities as $amenity)
                            <span class="lux-badge-outline">{{ $amenity }}</span>
                        @empty
                            <span class="lux-badge-outline">Amenidades sob consulta com concierge</span>
                        @endforelse
                    </div>
                </div>
                <div class="space-y-3">
                    <h3 class="text-xl font-semibold text-white">Documentos</h3>
                    <p class="text-sm text-white/60">Dossiês completos, matrícula e laudos são compartilhados diretamente pelo concierge após a abertura no WhatsApp.</p>
                </div>
            </article>
            <aside class="space-y-6">
                <div class="lux-card-dark space-y-4">
                    <h3 class="text-lg font-semibold text-white">Mapa (visualização artística)</h3>
                    <div class="h-64 overflow-hidden rounded-3xl border border-white/10" style="background: radial-gradient(circle at center, rgba(203,161,53,0.15), transparent 65%), linear-gradient(135deg, #0F0F0F 0%, #1A1A1A 100%);">
                        <div class="flex h-full items-center justify-center">
                            <div class="space-y-2 text-center">
                                <span class="lux-badge-gold">Localização confidencial</span>
                                <p class="text-sm text-white/60">Compartilhada após contato com o concierge.</p>
                            </div>
                        </div>
                    </div>
                    <ul class="space-y-2 text-sm text-white/60">
                        <li>Tipo: {{ ucfirst($property->type) }}</li>
                        <li>Transação: {{ $property->transaction_type === 'sale' ? 'Venda' : ($property->transaction_type === 'rent' ? 'Locação' : 'Venda ou locação') }}</li>
                        <li>Status: {{ $property->status_label }}</li>
                    </ul>
                </div>
                <div class="lux-card-dark space-y-3">
                    <h3 class="text-lg font-semibold text-white">Concierge Prime Match</h3>
                    <p class="text-sm text-white/60">Toda a negociação é conduzida no WhatsApp oficial (+55 14 99684-5854). Nenhum outro canal recebe leads.</p>
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Abrir WhatsApp</a>
                </div>
            </aside>
        </section>
    </div>
</div>

<div class="fixed inset-x-0 bottom-0 z-50 bg-[#0B0B0B]/90 backdrop-blur-xl border-t border-white/10">
    <div class="lux-container flex flex-col gap-4 py-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.3em] text-white/50">Concierge único disponível</p>
            <p class="text-lg font-semibold text-white">Fale agora com o concierge para avançar neste imóvel</p>
        </div>
        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com o concierge</a>
    </div>
</div>
@endsection
