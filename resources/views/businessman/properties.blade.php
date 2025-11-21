@extends('layouts.app')

@section('title', 'Minha Vitrine Prime')

@section('content')
@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
    use Illuminate\Support\Facades\Storage;

    $canManageProperties = $user->hasApprovedPropertyAccess();
@endphp

<div class="py-12">
    <div class="lux-container space-y-12">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="lux-badge-gold">Portfólio prime</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Imóveis cadastrados</h1>
                <p class="text-sm text-white/60">Atualize informações, acompanhe métricas e acione o concierge único para impulsionar cada ativo.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                @if($canManageProperties)
                    <a href="{{ route('businessman.property.create') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">+ Novo imóvel</a>
                @else
                    <span class="lux-outline-button text-xs uppercase tracking-[0.3em] text-white/60">Liberação pendente</span>
                @endif
                <a href="{{ route('businessman.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Voltar</a>
            </div>
        </div>

        @if(!$canManageProperties)
            <div class="rounded-2xl border border-amber-400/30 bg-amber-500/10 p-5 text-sm text-amber-100">
                <p class="font-semibold text-amber-50">Cadastro aguardando validação do Master.</p>
                <p class="mt-2 text-amber-100/80">Assim que o CRECI {{ $user->creci ?? 'não informado' }} for confirmado você poderá registrar novos imóveis.</p>
            </div>
        @endif

        @if($properties->count())
            <div class="lux-grid-cards">
                @foreach($properties as $property)
                    @php
                        $imagePath = optional($property->primaryImage)->path;
                        $image = $imagePath ? asset($imagePath) : asset('images/placeholders/luxury-property.svg');
                        $metrics = $property->dashboard_metrics ?? ['views30' => 0, 'clicks30' => 0, 'conversion' => 0];
                    @endphp
                    <article class="lux-property-card">
                        <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#0B0B0B]">
                            <img src="{{ $image }}" alt="{{ $property->title }}" class="h-40 w-full object-cover" loading="lazy" />
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $property->city }} • {{ $property->state }}</p>
                                    <h2 class="mt-2 text-xl font-semibold text-white">{{ $property->title }}</h2>
                                </div>
                                <span class="lux-property-status text-white/70">{{ $property->status_label }}</span>
                            </div>
                            <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-[1.6fr_1fr_1fr]">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</p>
                                    <p class="mt-1 text-lg font-semibold text-white">{{ Format::currency($property->price) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Visitas (30d)</p>
                                    <p class="mt-1 text-lg font-semibold text-white">{{ $metrics['views30'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Cliques (30d)</p>
                                    <p class="mt-1 text-lg font-semibold text-white">{{ $metrics['clicks30'] }}</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('businessman.property.edit', $property) }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Editar</a>
                                <form method="POST" action="{{ route('businessman.property.destroy', $property) }}" onsubmit="return confirm('Remover este imóvel prime?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Excluir</button>
                                </form>
                                <a href="{{ ConciergeLink::forBusinessmanSupport($property) }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Concierge</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div>
                {{ $properties->links() }}
            </div>
        @else
            <div class="rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                Nenhum imóvel cadastrado ainda. Publique seu primeiro anúncio e o concierge prime fará a curadoria com você.
            </div>
        @endif
    </div>
</div>
@endsection
