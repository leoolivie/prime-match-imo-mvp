@extends('layouts.app')

@section('title', 'Buscar imóveis · Investidor Prime')

@section('content')
@php
    use Illuminate\Support\Facades\Route;
@endphp

<div class="py-12">
    <div class="lux-container space-y-10">
        <header class="lux-card-dark">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-4">
                    <span class="lux-badge-gold">Nova busca</span>
                    <div class="space-y-3">
                        <h1 class="font-poppins text-4xl font-semibold text-white">Configure sua próxima busca Prime</h1>
                        <p class="max-w-2xl text-white/70">Defina tipologia, faixa de preço e áreas preferidas para receber resultados com curadoria concierge.</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('investor.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Voltar ao dashboard</a>
                    <a href="{{ route('investor.catalog') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Ver vitrine</a>
                </div>
            </div>
        </header>

        <section class="lux-card-dark">
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold text-white">Filtros inteligentes</h2>
                <p class="text-sm text-white/60">Quando enviar a busca o concierge registra o contexto e você pode salvar alertas exclusivos.</p>
            </div>

            <form action="{{ route('investor.search.results') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                <div class="grid gap-6 md:grid-cols-3">
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">
                        Tipologia
                        <select name="property_type" class="lux-select mt-2">
                            <option value="any">Qualquer</option>
                            <option value="apartment">Apartamento</option>
                            <option value="house">Casa</option>
                            <option value="commercial">Comercial</option>
                            <option value="land">Terreno</option>
                        </select>
                    </label>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">
                        Tipo de transação
                        <select name="transaction_type" class="lux-select mt-2">
                            <option value="both">Venda ou locação</option>
                            <option value="sale">Venda</option>
                            <option value="rent">Locação</option>
                        </select>
                    </label>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">
                        Cidade
                        <input type="text" name="city" class="lux-input mt-2" placeholder="São Paulo">
                    </label>
                </div>
                <div class="grid gap-6 md:grid-cols-3">
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">
                        Estado
                        <input type="text" name="state" class="lux-input mt-2 uppercase" maxlength="2" placeholder="SP">
                    </label>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">
                        Valor mínimo
                        <input type="number" name="min_price" class="lux-input mt-2" min="0" step="100000" placeholder="500000">
                    </label>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">
                        Valor máximo
                        <input type="number" name="max_price" class="lux-input mt-2" min="0" step="100000" placeholder="5000000">
                    </label>
                </div>
                <div class="grid gap-6 md:grid-cols-3">
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">
                        Quartos mínimos
                        <input type="number" name="min_bedrooms" class="lux-input mt-2" min="0" placeholder="2">
                    </label>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">
                        Banheiros mín.
                        <input type="number" name="min_bathrooms" class="lux-input mt-2" min="0" placeholder="2">
                    </label>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">
                        Área mínima (m²)
                        <input type="number" name="min_area" class="lux-input mt-2" min="0" placeholder="200">
                    </label>
                </div>
                <label class="flex items-center gap-3 text-xs uppercase tracking-[0.3em] text-white/50">
                    <input type="checkbox" name="create_alert" value="1" class="lux-switch">
                    Salvar alerta e receber notificações automáticas
                </label>
                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Buscar imóveis</button>
                    <a href="{{ route('investor.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Cancelar</a>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
