@extends('layouts.app')

@section('title', 'Master • Imóveis Prime')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-12">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="lux-badge-gold">Master • Imóveis</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Orquestração completa do inventário prime</h1>
                <p class="text-sm text-white/60">Analise status, owners e concierge de cada imóvel. Abra dashboards dedicados ou acione o concierge com um clique.</p>
            </div>
            <a href="{{ route('master.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Voltar ao dashboard</a>
        </div>

        <div class="lux-grid-cards">
            @forelse($properties as $property)
                <article class="lux-property-card">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $property->city }} • {{ $property->state }}</p>
                            <h2 class="mt-2 text-xl font-semibold text-white">{{ $property->title }}</h2>
                        </div>
                        <span class="lux-property-status text-white/70">{{ $property->status_label }}</span>
                    </div>
                    <p class="text-sm text-white/60">{{ \Illuminate\Support\Str::limit($property->description, 160) }}</p>
                    <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</p>
                            <p class="mt-1 text-lg font-semibold text-white">R$ {{ number_format($property->price, 2, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Owner</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ $property->owner->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Ativo</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ $property->active ? 'Sim' : 'Não' }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Leads</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ $property->leads_count ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, atualize o status do imóvel ' . $property->title . ' (ID ' . $property->id . ').') }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Concierge</a>
                        <a href="mailto:concierge@primematchimo.com.br?subject={{ rawurlencode('Atualização do imóvel ' . $property->title) }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Enviar briefing</a>
                        <a href="tel:+5514996845854" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ligar</a>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                    Nenhum imóvel cadastrado. Oriente empresários a adicionarem imóveis para abastecer o fluxo prime.
                </div>
            @endforelse
        </div>
        <div>
            {{ $properties->links() }}
        </div>
    </div>
</div>
@endsection
