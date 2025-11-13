@extends('layouts.app')

@section('title', 'Editar Imóvel em Destaque • Master')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-10">
        <div class="space-y-3">
            <span class="lux-badge-gold">Editar destaque prime</span>
            <h1 class="font-poppins text-3xl font-semibold text-white">Atualizar imóvel em destaque</h1>
            <p class="text-sm text-white/60">Ajuste textos, imagens e CTAs. Toda alteração reflete imediatamente na vitrine do investidor.</p>
        </div>

        <form action="{{ route('master.featured-properties.update', $featuredProperty) }}" method="POST" enctype="multipart/form-data" class="lux-card-dark space-y-8">
            @method('PUT')
            @include('master.featured-properties.partials.form', ['featuredProperty' => $featuredProperty])
        </form>
    </div>
</div>
@endsection
