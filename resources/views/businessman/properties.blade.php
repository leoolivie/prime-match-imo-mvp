@extends('layouts.app')

@section('title', 'Portfólio Prime - Empresário')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-12">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="lux-badge-gold">Portfólio prime</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Meus imóveis cinematográficos</h1>
                <p class="text-sm text-white/60">Gerencie cadastro, status e concierge de todas as oportunidades com brilho dourado.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('businessman.property.create') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">+ Novo imóvel</a>
                <a href="{{ route('businessman.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Voltar ao dashboard</a>
            </div>
        </div>

        @if($properties->count())
            <div class="lux-grid-cards">
                @foreach($properties as $property)
                    <article class="lux-property-card">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $property->city }} • {{ $property->state }}</p>
                                <h2 class="mt-2 text-xl font-semibold text-white">{{ $property->title }}</h2>
                            </div>
                            <span class="lux-property-status text-white/70">{{ ucfirst($property->status) }}</span>
                        </div>
                        <p class="text-sm text-white/60">{{ \Illuminate\Support\Str::limit($property->description, 140) }}</p>
                        <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</p>
                                <p class="mt-1 text-lg font-semibold text-white">R$ {{ number_format($property->price, 2, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Tipologia</p>
                                <p class="mt-1 text-lg font-semibold text-white">{{ ucfirst($property->type) }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Leads</p>
                                <p class="mt-1 text-lg font-semibold text-white">{{ $property->leads_count }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Concierge</p>
                                <p class="mt-1 text-lg font-semibold text-white">WhatsApp prime</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('businessman.property.edit', $property) }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Editar</a>
                            <form method="POST" action="{{ route('businessman.property.destroy', $property) }}" onsubmit="return confirm('Remover este imóvel prime?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Excluir</button>
                            </form>
                            <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, preciso impulsionar o imóvel ' . $property->title . '.') }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Concierge</a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div>
                {{ $properties->links() }}
            </div>
        @else
            <div class="rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                Nenhum imóvel cadastrado ainda. Cadastre o primeiro anúncio e o concierge prime cuidará do destaque.
            </div>
        @endif
    </div>
</div>
@endsection
