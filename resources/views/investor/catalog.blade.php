@extends('layouts.app')

@section('title', 'Prime Match Imo · Vitrine Investidor')

@section('content')
@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
@endphp

<div class="py-12">
    <div class="lux-container space-y-12">
        <header class="lux-card-dark">
            <div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-5">
                    <span class="lux-badge-gold">Vitrine Prime</span>
                    <div class="space-y-4">
                        <h1 class="font-poppins text-4xl font-semibold text-white">Descubra imóveis curados pelo concierge</h1>
                        <p class="max-w-2xl text-white/70">Filtre por cidade, tipologia, budget e m². Cada clique em "Falar com o Concierge" abre uma conversa no WhatsApp com mensagem pronta para acelerar a negociação.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button type="button" @click="window.dispatchEvent(new CustomEvent('busca-prime-open'))" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Ativar busca prime</button>
                        <a href="{{ ConciergeLink::build('investidor_card', [
                                'city' => 'Curadoria concierge',
                                'type' => 'matching personalizado',
                                'budget_min' => 8000000,
                            ], [
                                'user_type' => 'investidor',
                                'source' => 'catalog_header',
                            ]) }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.3em]">
                            Falar com concierge
                        </a>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Imóveis ativos</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($properties->total()) }}</span>
                        <span class="text-white/40">Vitrine atualizada</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Destaques concierge</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($featured->count()) }}</span>
                        <span class="text-white/40">Formato premium</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">WhatsApp únicos</span>
                        <span class="text-2xl font-semibold text-white">+1</span>
                        <span class="text-white/40">Atendimento master</span>
                    </div>
                </div>
            </div>
        </header>

        <section class="lux-card-dark space-y-8">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-semibold text-white">Filtros inteligentes</h2>
                    <p class="text-sm text-white/60">Os filtros alimentam a curadoria concierge e refinam as recomendações exibidas.</p>
                </div>
                <span class="lux-badge-outline">Telemetria agregada</span>
            </div>
            <form method="GET" action="{{ route('investor.catalog') }}" class="grid gap-4 md:grid-cols-6">
                <div class="md:col-span-2">
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Cidade</label>
                    <select name="city" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                        <option value="">Todas</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" @selected($filters['city'] === $city)>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Tipologia</label>
                    <select name="type" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                        <option value="">Todas</option>
                        <option value="apartment" @selected($filters['type'] === 'apartment')>Apartamento</option>
                        <option value="house" @selected($filters['type'] === 'house')>Casa</option>
                        <option value="commercial" @selected($filters['type'] === 'commercial')>Comercial</option>
                        <option value="land" @selected($filters['type'] === 'land')>Terreno</option>
                        <option value="other" @selected($filters['type'] === 'other')>Outro</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Faixa de preço</label>
                    <select name="price_range" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                        <option value="">Todas</option>
                        <option value="0-5" @selected(request('price_range') === '0-5')>Até R$ 5M</option>
                        <option value="5-10" @selected(request('price_range') === '5-10')>R$ 5M - R$ 10M</option>
                        <option value="10-20" @selected(request('price_range') === '10-20')>R$ 10M - R$ 20M</option>
                        <option value="20+" @selected(request('price_range') === '20+')>Acima de R$ 20M</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Quartos mínimos</label>
                    <input type="number" name="bedrooms" value="{{ $filters['bedrooms'] ?? '' }}" min="0" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Qualquer" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Mínimo de m²</label>
                    <input type="number" name="area_min" value="{{ $filters['area_min'] ?? '' }}" min="0" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Sob consulta" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Ordenação</label>
                    <select name="sort" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                        <option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>Mais recentes</option>
                        <option value="price_desc" @selected(($filters['sort'] ?? '') === 'price_desc')>Maior valor</option>
                        <option value="price_asc" @selected(($filters['sort'] ?? '') === 'price_asc')>Menor valor</option>
                        <option value="area_desc" @selected(($filters['sort'] ?? '') === 'area_desc')>Maior m²</option>
                    </select>
                </div>
                <div class="md:col-span-6 flex justify-end gap-3">
                    <a href="{{ route('investor.catalog') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Limpar</a>
                    <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Aplicar filtros</button>
                </div>
            </form>
        </section>

        <section class="space-y-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-white">{{ $properties->total() }} imóveis encontrados</h2>
                <span class="lux-badge-outline">Todos acompanham concierge</span>
            </div>
            <div class="lux-grid-cards">
                @forelse($properties as $property)
                    @php
                        $image = optional($property->primaryImage)->path
                            ? asset('storage/' . $property->primaryImage->path)
                            : asset('images/placeholders/luxury-property.svg');
                        $amenities = collect($property->features ?? [])->filter()->take(2);
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
                                @if($property->highlighted)
                                    <span class="lux-badge-gold">Curadoria concierge</span>
                                @endif
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
                                @forelse($amenities as $amenity)
                                    <span class="lux-badge-outline">{{ $amenity }}</span>
                                @empty
                                    <span class="lux-badge-outline">Amenidades sob consulta</span>
                                @endforelse
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('properties.show', ['property' => $property, 'source' => 'catalog']) }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver detalhes</a>
                                <a href="{{ ConciergeLink::forInvestorCard($property) }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com o concierge</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="lux-card-dark md:col-span-3">
                        <h3 class="text-xl font-semibold text-white">Nenhum imóvel encontrado</h3>
                        <p class="mt-3 text-sm text-white/60">Ajuste os filtros ou acione o concierge prime para receber novas recomendações.</p>
                        <a href="{{ ConciergeLink::build('investidor_card', ['city' => 'Nova busca prime', 'type' => 'curadoria personalizada'], ['user_type' => 'investidor', 'source' => 'catalog_empty']) }}" target="_blank" rel="noopener" class="mt-4 inline-flex">
                            <span class="lux-gold-button text-xs uppercase tracking-[0.3em]">Concierge agora</span>
                        </a>
                    </div>
                @endforelse
            </div>
            <div>
                {{ $properties->links() }}
            </div>
        </section>
    </div>
</div>

<div x-data="buscaPrime()" x-cloak @busca-prime-open.window="open = true" class="relative">
    <template x-if="open">
        <div class="fixed inset-0 z-[60] flex items-center justify-center bg-black/80 px-4 py-10">
            <div class="w-full max-w-xl space-y-6 rounded-3xl border border-white/10 bg-[#0D0D0D] p-8 shadow-[0_35px_90px_rgba(0,0,0,0.55)]">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-white">Busca Prime Concierge</h2>
                        <p class="mt-2 text-sm text-white/60">Preencha rapidamente e abra o WhatsApp com mensagem pronta para o concierge único.</p>
                    </div>
                    <button type="button" class="lux-outline-button px-4 py-2 text-xs uppercase tracking-[0.3em]" @click="reset()">Fechar</button>
                </div>
                <form class="space-y-4" @submit.prevent="submit">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">Cidade</label>
                            <input type="text" x-model="form.city" placeholder="Ex.: São Paulo" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                        </div>
                        <div>
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">Tipo de imóvel</label>
                            <input type="text" x-model="form.type" placeholder="Cobertura, casa, laje corporativa..." class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                        </div>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">Budget mínimo</label>
                            <input type="number" min="0" x-model="form.budget_min" placeholder="5000000" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                        </div>
                        <div>
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">Budget máximo</label>
                            <input type="number" min="0" x-model="form.budget_max" placeholder="20000000" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                        </div>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Preferências</label>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <template x-for="tag in tags" :key="tag">
                                <button type="button" @click="toggleTag(tag)" class="lux-badge-outline" :class="form.tags.includes(tag) ? 'border-lux-gold/70 text-white' : ''" x-text="tag"></button>
                            </template>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Urgência</label>
                        <select x-model="form.urgency" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                            <option value="">Selecione</option>
                            <option value="Imediata">Imediata</option>
                            <option value="Próximos 30 dias">Próximos 30 dias</option>
                            <option value="Planejamento">Planejamento</option>
                        </select>
                    </div>
                    <div class="flex flex-wrap justify-end gap-3 pt-4">
                        <button type="button" class="lux-outline-button text-xs uppercase tracking-[0.3em]" @click="reset()">Cancelar</button>
                        <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Abrir WhatsApp</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>

@push('scripts')
<script>
    function buscaPrime() {
        return {
            open: false,
            tags: ['Vista panorâmica', 'Pé na areia', 'Heliponto', 'Triple A', 'Residencial clube', 'Turn key'],
            form: {
                city: '',
                type: '',
                budget_min: '',
                budget_max: '',
                tags: [],
                urgency: '',
            },
            toggleTag(tag) {
                if (this.form.tags.includes(tag)) {
                    this.form.tags = this.form.tags.filter((item) => item !== tag);
                } else {
                    this.form.tags = [...this.form.tags, tag];
                }
            },
            reset() {
                this.open = false;
                this.form = {
                    city: '',
                    type: '',
                    budget_min: '',
                    budget_max: '',
                    tags: [],
                    urgency: '',
                };
            },
            submit() {
                const payload = {
                    city: this.form.city,
                    type: this.form.type,
                    budget_min: this.form.budget_min,
                    budget_max: this.form.budget_max,
                    tags: this.form.tags,
                    urgency: this.form.urgency,
                };

                const url = new URL('{{ route('concierge.redirect') }}');
                url.searchParams.set('context', 'busca_prime');
                url.searchParams.set('user_type', 'investidor');
                url.searchParams.set('source', 'busca_prime_modal');
                url.searchParams.set('payload', btoa(unescape(encodeURIComponent(JSON.stringify(payload)))));

                window.open(url.toString(), '_blank');
                this.reset();
            },
        };
    }
</script>
@endpush
@endsection
