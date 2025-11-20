@extends('layouts.app')

@section('title', 'Resultados da busca · Investidor Prime')

@section('content')
@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
    use Illuminate\Support\Facades\Storage;
@endphp

<div class="py-12">
    <div class="lux-container space-y-8">
        <header class="lux-card-dark">
            <div class="flex flex-col gap-4">
                <span class="lux-badge-gold">Busca Prime</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Resultados encontrados</h1>
                <p class="text-sm text-white/60">Reúna os imóveis que passam pelo filtro e fale com o concierge para acompanhar visitas em tempo real.</p>
            </div>
        </header>

        <section class="space-y-6">
            <div class="lux-grid-cards">
                @forelse($properties as $property)
                    @php
                        $imagePath = optional($property->primaryImage)->path;
                        $image = $imagePath ? '/public/' . ltrim($imagePath, '/') : asset('images/placeholders/luxury-property.svg');
                    @endphp
                    <article class="lux-property-card">
                        <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#0B0B0B]">
                            <img src="{{ $image }}" alt="{{ $property->title }}" class="h-52 w-full object-cover" loading="lazy" />
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="text-xl font-semibold text-white">{{ $property->title }}</h3>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $property->city }} • {{ $property->state }}</p>
                                </div>
                            </div>
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
                            <div class="flex flex-wrap gap-2 text-sm text-white/60">
                                <span class="lux-badge-outline">{{ ucfirst($property->transaction_type ?? 'Venda & Locação') }}</span>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('properties.show', ['property' => $property, 'source' => 'search']) }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver detalhes</a>
                                <a href="{{ ConciergeLink::forInvestorCard($property) }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com o concierge</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="lux-card-dark text-sm">
                        <h3 class="text-xl font-semibold text-white">Nenhum imóvel corresponde aos filtros</h3>
                        <p class="mt-2 text-white/60">Ajuste os parâmetros ou acione o concierge prime para receber novas recomendações.</p>
                        <a href="{{ ConciergeLink::build('investidor_card', ['city' => 'Nova busca prime', 'type' => 'curadoria personalizada'], ['user_type' => 'investidor', 'source' => 'search_empty']) }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Concierge agora</a>
                    </div>
                @endforelse
            </div>
            <div>
                {{ $properties->links() }}
            </div>
        </section>
    </div>
</div>
@endsection
