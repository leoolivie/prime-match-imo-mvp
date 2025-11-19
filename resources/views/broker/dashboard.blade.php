@extends('layouts.app')

@section('title', 'Painel Prime · Concierge')

@section('content')
@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
    use Illuminate\Support\Facades\Storage;
@endphp

<div class="bg-[#0B0B0B] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1.25fr_1fr] lg:items-start">
            <div class="space-y-6">
                <span class="inline-flex items-center rounded-full border border-[#2A2A2A] bg-[#111111] px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#CBA135]">
                    Concierge prime
                </span>
                <div class="space-y-4">
                    <h1 class="text-4xl font-semibold text-white sm:text-5xl">
                        Curadoria compartilhada com apoio direto do concierge
                    </h1>
                    <p class="text-lg text-white/70">
                        Olá, {{ $user->name }}. O fluxo de negociação acontece 100% via WhatsApp com o concierge master.
                        Use o painel para acompanhar performance agregada dos imóveis e acionar a curadoria quando precisar de reforço.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ $supportLink }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center rounded-2xl bg-[#CBA135] px-6 py-3 text-sm font-semibold text-black shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-colors hover:bg-[#B38A2F] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#CBA135]/70">
                        Falar com o concierge
                    </a>
                    <p class="max-w-sm text-sm text-white/60">
                        Dica: compartilhe com o concierge insights sobre perfil dos investidores para acelerar as indicações personalizadas.
                    </p>
                </div>
            </div>
            <div class="rounded-2xl border border-[#2A2A2A] bg-gradient-to-br from-[#161616] to-[#0B0B0B] p-8 shadow-[0_12px_40px_rgba(0,0,0,0.45)]">
                <h2 class="text-lg font-semibold text-white">Resumo concierge · últimos 30 dias</h2>
                <dl class="mt-6 space-y-6">
                    <div class="flex items-start justify-between gap-6">
                        <div>
                            <dt class="text-xs uppercase tracking-[0.3em] text-white/40">Visitas ao catálogo</dt>
                            <dd class="mt-2 text-3xl font-semibold text-white">{{ number_format($stats['views30']) }}</dd>
                        </div>
                        <span class="rounded-full border border-[#2A2A2A] bg-white/5 px-3 py-1 text-xs font-semibold text-white/70">7 dias: {{ number_format($stats['views7']) }}</span>
                    </div>
                    <div class="flex items-start justify-between gap-6">
                        <div>
                            <dt class="text-xs uppercase tracking-[0.3em] text-white/40">Cliques no concierge</dt>
                            <dd class="mt-2 text-3xl font-semibold text-[#CBA135]">{{ number_format($stats['conciergeClicks30']) }}</dd>
                        </div>
                        <span class="rounded-full border border-[#2A2A2A] bg-white/5 px-3 py-1 text-xs font-semibold text-white/70">7 dias: {{ number_format($stats['conciergeClicks7']) }}</span>
                    </div>
                    <div class="flex items-start justify-between gap-6">
                        <div>
                            <dt class="text-xs uppercase tracking-[0.3em] text-white/40">Busca prime acionada</dt>
                            <dd class="mt-2 text-3xl font-semibold text-white">{{ number_format($stats['buscaPrime30']) }}</dd>
                        </div>
                        <span class="rounded-full border border-[#2A2A2A] bg-white/5 px-3 py-1 text-xs font-semibold text-white/70">WhatsApp</span>
                    </div>
                    <div class="flex items-start justify-between gap-6">
                        <div>
                            <dt class="text-xs uppercase tracking-[0.3em] text-white/40">Conversão concierge</dt>
                            <dd class="mt-2 text-3xl font-semibold text-white">{{ number_format($stats['conversion'], 1, ',', '.') }}%</dd>
                        </div>
                        <span class="rounded-full border border-[#2A2A2A] bg-white/5 px-3 py-1 text-xs font-semibold text-white/70">Meta: 12%</span>
                    </div>
                </dl>
            </div>
        </div>

        <section class="mt-16 space-y-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-semibold text-white">Imóveis monitorados</h2>
                    <p class="text-sm text-white/60">Dados consolidados dos últimos 30 dias para apoiar decisões de curadoria.</p>
                </div>
                <a href="{{ $supportLink }}" target="_blank" rel="noopener" class="inline-flex items-center rounded-2xl border border-[#CBA135]/40 bg-[#111111] px-5 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-[#CBA135] transition-colors hover:border-[#CBA135] hover:text-[#CBA135] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#CBA135]/70">
                    Solicitar reforço do concierge
                </a>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($properties as $property)
                    @php
                        $image = optional($property->primaryImage)->path
                            ? Storage::disk('public')->url($property->primaryImage->path)
                            : asset('images/placeholders/luxury-property.svg');
                        $analytics = $property->analytics ?? ['views30' => 0, 'conciergeClicks30' => 0, 'conversion' => 0];
                    @endphp
                    <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-[#2A2A2A] bg-[#111111] shadow-[0_8px_30px_rgba(0,0,0,0.35)]">
                        <div class="relative overflow-hidden">
                            <img src="{{ $image }}" alt="Prévia do imóvel {{ $property->title }}" class="h-48 w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        </div>
                        <div class="flex flex-1 flex-col space-y-5 p-6">
                            <div class="space-y-2">
                                <p class="text-xs uppercase tracking-[0.3em] text-white/40">{{ $property->city }} / {{ $property->state }}</p>
                                <h3 class="text-xl font-semibold text-white">{{ $property->title }}</h3>
                                <p class="text-sm text-white/60">{{ ucfirst($property->type) }} · {{ Format::area($property->area) }} · {{ Format::integer($property->bedrooms) }} quartos · {{ Format::integer($property->suites) }} suítes</p>
                                <p class="text-lg font-semibold text-[#CBA135]">{{ Format::currency($property->price) }}</p>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-center justify-between text-white/60">
                                    <span>Visitas (30d)</span>
                                    <span class="font-semibold text-white">{{ number_format($analytics['views30']) }}</span>
                                </div>
                                <div class="flex items-center justify-between text-white/60">
                                    <span>Cliques concierge</span>
                                    <span class="font-semibold text-white">{{ number_format($analytics['conciergeClicks30']) }}</span>
                                </div>
                                <div class="flex items-center justify-between text-white/60">
                                    <span>Conversão</span>
                                    <span class="font-semibold text-[#CBA135]">{{ number_format($analytics['conversion'], 1, ',', '.') }}%</span>
                                </div>
                            </div>
                            <div class="mt-auto flex flex-wrap items-center gap-3 pt-2">
                                <a href="{{ route('properties.show', ['property' => $property, 'source' => 'broker_dashboard']) }}" class="inline-flex flex-1 items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-white transition-colors hover:border-white/30 hover:bg-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#CBA135]/70">
                                    Ver detalhes
                                </a>
                                <a href="{{ ConciergeLink::forBrokerSupport($property) }}" target="_blank" rel="noopener" class="inline-flex flex-1 items-center justify-center rounded-2xl bg-[#CBA135] px-4 py-2 text-sm font-semibold text-black transition-colors hover:bg-[#B38A2F] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#CBA135]/70">
                                    Alinhar concierge
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-2xl border border-[#2A2A2A] bg-[#111111] p-12 text-center text-white/60">
                        Nenhum imóvel ativo para monitorar no momento. Publique um anúncio ou converse com o concierge para priorizar novos ativos.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection
