@extends('layouts.app')

@section('title', 'Investidores - Prime Match Imo')

@section('content')
    <span class="sr-only">Experiência prime para investidores</span>
    @include('components.prime-featured-section', [
        'featured' => $featured,
        'title' => 'Coleção Prime para investidores',
        'subtitle' => 'Imóveis curados pelo Master com concierge dedicado antes de qualquer outra informação.',
    ])

    <section class="relative overflow-hidden bg-gradient-to-b from-black via-[#0A0A0A] to-black">
        <div class="lux-container py-20">
            <div class="relative overflow-hidden rounded-[40px] border border-white/10 bg-black/70 shadow-[0_0_80px_rgba(0,0,0,0.6)]">
                <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr]">
                    <div class="space-y-8 p-10">
                        <span class="lux-badge-gold">Coleção destaque</span>
                        <h1 class="font-poppins text-4xl font-semibold leading-tight text-white sm:text-5xl">
                            Cobertura cinematográfica nos Jardins com concierge dedicado
                        </h1>
                        <p class="max-w-2xl text-base text-white/70 sm:text-lg">
                            Agenda preferencial para visitas privativas, dossiê completo auditado e negociação assistida pelo concierge Prime Match Imo.
                        </p>
                        <div class="grid gap-4 sm:grid-cols-3">
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                <p class="text-[11px] uppercase tracking-[0.35em] text-white/40">Valor</p>
                                <p class="mt-2 text-xl font-semibold text-white">R$ 12.800.000</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                <p class="text-[11px] uppercase tracking-[0.35em] text-white/40">Cap rate</p>
                                <p class="mt-2 text-xl font-semibold text-white">8,7% a.a.</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                <p class="text-[11px] uppercase tracking-[0.35em] text-white/40">Disponibilidade</p>
                                <p class="mt-2 text-xl font-semibold text-white">Visita 48h</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('register') }}" class="lux-gold-button text-sm uppercase tracking-[0.25em]">
                                Agendar visita privativa
                            </a>
                            <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, gostaria de receber o dossiê completo da cobertura cinematográfica nos Jardins.') }}" target="_blank" rel="noopener" class="lux-outline-button text-sm uppercase tracking-[0.25em]">
                                Solicitar dossiê via concierge
                            </a>
                        </div>
                        <div class="grid gap-4 text-sm text-white/65">
                            <div class="flex items-center gap-3">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full border border-lux-gold/40 bg-lux-gold/10 text-lux-gold">✦</span>
                                <span>Programação de hospitalidade Fasano e concierge 24/7.</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full border border-lux-gold/40 bg-lux-gold/10 text-lux-gold">✦</span>
                                <span>Documentação auditada pelo Prime Network e compliance jurídico sem apontamentos.</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full border border-lux-gold/40 bg-lux-gold/10 text-lux-gold">✦</span>
                                <span>Roadshow privado com incorporador e captação preferencial.</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative min-h-[420px]">
                        <img src="{{ asset('images/investor/hero-highlight.svg') }}" alt="Imóvel destaque" class="h-full w-full object-cover" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#050505] py-20">
        <div class="lux-container space-y-12">
            <div class="grid gap-6 rounded-[30px] border border-white/10 bg-white/5 p-8 shadow-[0_0_60px_rgba(0,0,0,0.35)]">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-white/50">Curadoria filtrada</p>
                        <h2 class="font-poppins text-3xl font-semibold text-white">Refine sua busca prime</h2>
                    </div>
                    <a href="{{ route('investor.search') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ativar busca assistida</a>
                </div>
                <div class="grid gap-4 md:grid-cols-4">
                    <label class="grid gap-2 text-sm text-white/70">
                        <span class="text-[11px] uppercase tracking-[0.3em] text-white/40">Cidade</span>
                        <select class="rounded-2xl border border-white/15 bg-black/60 px-4 py-3 text-sm text-white/80 focus:border-lux-gold/60 focus:outline-none">
                            <option>São Paulo</option>
                            <option>Balneário Camboriú</option>
                            <option>Florianópolis</option>
                            <option>Rio de Janeiro</option>
                        </select>
                    </label>
                    <label class="grid gap-2 text-sm text-white/70">
                        <span class="text-[11px] uppercase tracking-[0.3em] text-white/40">Tipologia</span>
                        <select class="rounded-2xl border border-white/15 bg-black/60 px-4 py-3 text-sm text-white/80 focus:border-lux-gold/60 focus:outline-none">
                            <option>Residencial</option>
                            <option>Corporate</option>
                            <option>Branded residences</option>
                            <option>Triple net</option>
                        </select>
                    </label>
                    <label class="grid gap-2 text-sm text-white/70">
                        <span class="text-[11px] uppercase tracking-[0.3em] text-white/40">Valor mínimo</span>
                        <input type="text" value="R$ 5.000.000" class="rounded-2xl border border-white/15 bg-black/60 px-4 py-3 text-sm text-white/80 focus:border-lux-gold/60 focus:outline-none" />
                    </label>
                    <label class="grid gap-2 text-sm text-white/70">
                        <span class="text-[11px] uppercase tracking-[0.3em] text-white/40">Valor máximo</span>
                        <input type="text" value="R$ 60.000.000" class="rounded-2xl border border-white/15 bg-black/60 px-4 py-3 text-sm text-white/80 focus:border-lux-gold/60 focus:outline-none" />
                    </label>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-3 text-xs uppercase tracking-[0.3em] text-white/40">
                    <span>12 oportunidades mapeadas para o seu perfil</span>
                    <button type="button" class="text-white/60 underline-offset-4 hover:text-white hover:underline">Limpar filtros</button>
                </div>
            </div>

            <div class="space-y-6">
                <p class="text-xs uppercase tracking-[0.35em] text-white/45">Patrocinadores oficiais</p>
                <div class="grid gap-6 rounded-[28px] border border-white/10 bg-white/5 p-6 sm:grid-cols-3">
                    <div class="flex items-center justify-center rounded-2xl border border-white/10 bg-black/40 p-6">
                        <span class="text-lg font-semibold uppercase tracking-[0.4em] text-white/60">Fasano</span>
                    </div>
                    <div class="flex items-center justify-center rounded-2xl border border-white/10 bg-black/40 p-6">
                        <span class="text-lg font-semibold uppercase tracking-[0.4em] text-white/60">JHSF</span>
                    </div>
                    <div class="flex items-center justify-center rounded-2xl border border-white/10 bg-black/40 p-6">
                        <span class="text-lg font-semibold uppercase tracking-[0.4em] text-white/60">Prime Network</span>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex flex-col gap-3">
                    <p class="text-xs uppercase tracking-[0.35em] text-white/45">Coleção signature</p>
                    <h2 class="font-poppins text-3xl font-semibold text-white">Outros imóveis selecionados</h2>
                    <p class="max-w-3xl text-sm text-white/60">Conheça oportunidades recém-listadas com dossiê disponível, concierge imediato e métricas financeiras validadas.</p>
                </div>

                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    <article class="flex h-full flex-col overflow-hidden rounded-[28px] border border-white/10 bg-white/5 shadow-[0_30px_120px_rgba(0,0,0,0.45)]">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('images/investor/property-balneario.svg') }}" alt="Cobertura frente mar" class="h-full w-full object-cover transition duration-500 hover:scale-105" />
                        </div>
                        <div class="space-y-5 p-6">
                            <div class="space-y-2">
                                <p class="text-xs uppercase tracking-[0.35em] text-white/45">Balneário Camboriú • Branded residence</p>
                                <h3 class="font-poppins text-xl font-semibold text-white">Penthouse pé-na-areia com beach club</h3>
                                <p class="text-sm text-white/60">Cap rate projetado em 9,1% a.a. com operação hoteleira internacional e concierge residente.</p>
                            </div>
                            <div class="grid gap-3 rounded-2xl border border-white/10 bg-black/30 p-4 sm:grid-cols-3">
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Valor</p>
                                    <p class="mt-1 text-lg font-semibold text-white">R$ 18.400.000</p>
                                </div>
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Upside</p>
                                    <p class="mt-1 text-lg font-semibold text-white">+14% concierge</p>
                                </div>
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Status</p>
                                    <p class="mt-1 text-lg font-semibold text-white">Roadshow</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('register') }}" class="lux-gold-button text-xs uppercase tracking-[0.25em]">Agendar visita</a>
                                <a href="https://wa.me/5514996845854?text={{ rawurlencode('Tenho interesse no penthouse pé-na-areia com beach club em Balneário Camboriú.') }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Concierge</a>
                            </div>
                        </div>
                    </article>

                    <article class="flex h-full flex-col overflow-hidden rounded-[28px] border border-white/10 bg-white/5 shadow-[0_30px_120px_rgba(0,0,0,0.45)]">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('images/investor/property-novalima.svg') }}" alt="Penthouse Nova Lima" class="h-full w-full object-cover transition duration-500 hover:scale-105" />
                        </div>
                        <div class="space-y-5 p-6">
                            <div class="space-y-2">
                                <p class="text-xs uppercase tracking-[0.35em] text-white/45">Nova Lima • High-end</p>
                                <h3 class="font-poppins text-xl font-semibold text-white">Triplex com vista permanente</h3>
                                <p class="text-sm text-white/60">Residência suspensa com 1.100m², heliponto homologado e concierge privado para diligências.</p>
                            </div>
                            <div class="grid gap-3 rounded-2xl border border-white/10 bg-black/30 p-4 sm:grid-cols-3">
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Valor</p>
                                    <p class="mt-1 text-lg font-semibold text-white">R$ 27.600.000</p>
                                </div>
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Cap rate</p>
                                    <p class="mt-1 text-lg font-semibold text-white">8,2% a.a.</p>
                                </div>
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Disponibilidade</p>
                                    <p class="mt-1 text-lg font-semibold text-white">Sob consulta</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('register') }}" class="lux-gold-button text-xs uppercase tracking-[0.25em]">Solicitar dossiê</a>
                                <a href="https://wa.me/5514996845854?text={{ rawurlencode('Gostaria de falar sobre o triplex com vista permanente em Nova Lima.') }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Falar com concierge</a>
                            </div>
                        </div>
                    </article>

                    <article class="flex h-full flex-col overflow-hidden rounded-[28px] border border-white/10 bg-white/5 shadow-[0_30px_120px_rgba(0,0,0,0.45)]">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('images/investor/property-corporate.svg') }}" alt="Campus corporativo" class="h-full w-full object-cover transition duration-500 hover:scale-105" />
                        </div>
                        <div class="space-y-5 p-6">
                            <div class="space-y-2">
                                <p class="text-xs uppercase tracking-[0.35em] text-white/45">Florianópolis • Corporate</p>
                                <h3 class="font-poppins text-xl font-semibold text-white">Campus tech triple net</h3>
                                <p class="text-sm text-white/60">Contrato de 12 anos, expansão planejada e diligência jurídica conduzida pela Prime Network.</p>
                            </div>
                            <div class="grid gap-3 rounded-2xl border border-white/10 bg-black/30 p-4 sm:grid-cols-3">
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Valor</p>
                                    <p class="mt-1 text-lg font-semibold text-white">R$ 42.000.000</p>
                                </div>
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">Cap rate</p>
                                    <p class="mt-1 text-lg font-semibold text-white">9,2% a.a.</p>
                                </div>
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.3em] text-white/40">War room</p>
                                    <p class="mt-1 text-lg font-semibold text-white">Ativo</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('register') }}" class="lux-gold-button text-xs uppercase tracking-[0.25em]">Negociar agora</a>
                                <a href="https://wa.me/5514996845854?text={{ rawurlencode('Quero avançar com o campus tech triple net em Florianópolis.') }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Concierge imediato</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    @include('landing.partials.investor')
@endsection
