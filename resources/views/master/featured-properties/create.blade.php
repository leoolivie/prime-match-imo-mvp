@extends('layouts.app')

@section('title', 'Novo Imóvel em Destaque • Master')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-10">
        <div class="relative overflow-hidden rounded-[36px] border border-white/5 bg-gradient-to-br from-[#101010] via-[#0b0b0b] to-[#050505] p-10 shadow-[0_35px_120px_rgba(0,0,0,0.55)]">
            <div class="absolute inset-0 opacity-40" style="background: radial-gradient(circle at top left, rgba(203,161,53,0.2), transparent 55%);"></div>
            <div class="relative grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
                <div class="space-y-4">
                    <span class="lux-badge-gold">Cadastrar destaque prime</span>
                    <h1 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Novo imóvel em destaque</h1>
                    <p class="text-sm text-white/65 sm:text-base">Preencha com cuidado os dados que irão compor a vitrine principal exibida aos investidores na abertura da Prime Match Imo.</p>
                    <div class="flex flex-wrap gap-3 text-[11px] uppercase tracking-[0.35em] text-white/60">
                        <span class="rounded-full border border-white/10 px-3 py-1">Curadoria concierge</span>
                        <span class="rounded-full border border-white/10 px-3 py-1">Imagens hero em 4K</span>
                        <span class="rounded-full border border-white/10 px-3 py-1">CTA WhatsApp</span>
                    </div>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-6 text-sm text-white/70">
                    <p class="text-xs uppercase tracking-[0.35em] text-white/50">Checklist de excelência</p>
                    <ul class="mt-4 space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="text-lux-gold">✶</span>
                            <span>Preço e área em padrão PT-BR para manter consistência com a vitrine pública.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-lux-gold">✶</span>
                            <span>Links "Ver imóvel" e "Concierge" com tracking claro para o time comercial.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-lux-gold">✶</span>
                            <span>Galeria hero com proporção horizontal e contraste premium.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <form action="{{ route('master.featured-properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @include('master.featured-properties.partials.form', ['featuredProperty' => $featuredProperty])
        </form>
    </div>
</div>
@endsection
