@extends('layouts.app')

@section('title', 'Prime Match Imo · Vitrine Investidor')

@section('content')
@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
    use Illuminate\Support\Str;

    $asset = fn(string $path) => app()->environment(['local', 'testing']) ? asset($path) : asset('public/' . ltrim($path, '/'));
@endphp

@include('components.prime-featured-section', [
    'featured' => $featured,
    'title' => 'Imóveis Prime em destaque',
    'subtitle' => 'Seleção fixa do Master exibida antes de qualquer outro ativo no catálogo.',
])

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
            <form method="GET" action="{{ route('investor.catalog') }}" class="grid gap-4 md:grid-cols-6" x-data="filtrosInteligentes">
                <div class="md:col-span-2">
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Cidade</label>
                    <select name="city" class="mt-2 lux-select">
                        <option value="">Todas</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" @selected($filters['city'] === $city)>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Tipologia</label>
                    <select name="type" class="mt-2 lux-select">
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
                    <select name="price_range" class="mt-2 lux-select">
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
                    <select name="sort" class="mt-2 lux-select">
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

        <section class="space-y-6" x-data="luxCarousel">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="space-y-1">
                    <h2 class="text-2xl font-semibold text-white">{{ $properties->total() }} imóveis encontrados</h2>
                    <p class="text-sm text-white/60">Passe o mouse para ver destaques rápidos e deslize no carrossel.</p>
                </div>
                <span class="lux-badge-outline">Todos acompanham concierge</span>
            </div>
            <div class="relative">
                <button type="button" @click="scrollPrev" :disabled="!canPrev" class="absolute left-0 z-10 hidden h-full w-12 items-center justify-center rounded-l-2xl bg-gradient-to-r from-black/80 to-transparent text-white transition hover:from-black/95 sm:flex" :class="{ 'opacity-50 cursor-not-allowed': !canPrev }" aria-label="Voltar carrossel">
                    ←
                </button>
                <div class="overflow-hidden">
                    <div class="flex gap-5 overflow-x-auto pb-4 pr-2 pt-1 sm:scroll-smooth [&::-webkit-scrollbar]:hidden" x-ref="track" style="scrollbar-width: none;" @wheel.prevent="scrollByWheel($event)">
                        @forelse($properties as $property)
                            @php
                                $imagePath = optional($property->primaryImage)->path;
                                $image = $property->mediaUrl($imagePath) ?? $asset('images/placeholders/luxury-property.svg');
                                $amenities = collect($property->features ?? [])->filter()->take(3);
                                $summary = Str::limit($property->short_description ?? $property->description ?? 'Detalhes sob consulta com o concierge.', 120);
                            @endphp
                            <article class="group relative flex min-w-[320px] max-w-[360px] flex-col gap-4 rounded-3xl border border-white/5 bg-gradient-to-b from-white/5 to-black/40 p-4 shadow-[0_10px_40px_rgba(0,0,0,0.4)] transition duration-300 hover:-translate-y-1 hover:border-lux-gold/50 hover:shadow-[0_20px_50px_rgba(0,0,0,0.6)]">
                                <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-[#0B0B0B]">
                                    <img src="{{ $image }}" alt="{{ $property->title }}" class="h-56 w-full object-cover transition duration-300 group-hover:scale-[1.03]" loading="lazy" />
                                    <div class="pointer-events-none absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black via-black/60 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                        <div class="space-y-3 p-4">
                                            <div class="flex items-center gap-2 text-[11px] uppercase tracking-[0.3em] text-lux-gold">
                                                <span>Concierge ativo</span>
                                                <span class="h-px flex-1 bg-white/20"></span>
                                            </div>
                                            <p class="text-sm text-white/80">{{ $summary }}</p>
                                            <div class="flex flex-wrap gap-2 text-[13px] text-white/70">
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
                                            <div class="flex flex-wrap gap-2 text-[13px] text-white/60">
                                                @forelse($amenities as $amenity)
                                                    <span class="lux-badge-outline">{{ $amenity }}</span>
                                                @empty
                                                    <span class="lux-badge-outline">Amenidades sob consulta</span>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <h3 class="text-lg font-semibold text-white">{{ $property->title }}</h3>
                                            <p class="text-[11px] uppercase tracking-[0.3em] text-white/50">{{ $property->city }} • {{ $property->state }}</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-2 text-[13px] text-white/70">
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
                                    <div class="flex flex-wrap gap-2 text-[13px] text-white/60">
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
                            <div class="lux-card-dark w-full">
                                <h3 class="text-xl font-semibold text-white">Nenhum imóvel encontrado</h3>
                                <p class="mt-3 text-sm text-white/60">Ajuste os filtros ou acione o concierge prime para receber novas recomendações.</p>
                                <a href="{{ ConciergeLink::build('investidor_card', ['city' => 'Nova busca prime', 'type' => 'curadoria personalizada'], ['user_type' => 'investidor', 'source' => 'catalog_empty']) }}" target="_blank" rel="noopener" class="mt-4 inline-flex">
                                    <span class="lux-gold-button text-xs uppercase tracking-[0.3em]">Concierge agora</span>
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
                <button type="button" @click="scrollNext" :disabled="!canNext" class="absolute right-0 top-0 z-10 hidden h-full w-12 items-center justify-center rounded-r-2xl bg-gradient-to-l from-black/80 to-transparent text-white transition hover:from-black/95 sm:flex" :class="{ 'opacity-50 cursor-not-allowed': !canNext }" aria-label="Avançar carrossel">
                    →
                </button>
            </div>
            <div>
                {{ $properties->links() }}
            </div>
        </section>

        <section class="lux-card-dark space-y-6" x-data="investorBriefingForm">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-2">
                    <span class="lux-badge-outline">Nao encontrou o imovel?</span>
                    <h2 class="text-2xl font-semibold text-white">Ativamos a busca manual do concierge</h2>
                    <p class="text-sm text-white/70">Envie seu briefing detalhado. Encaminharemos automaticamente para o Master pelo WhatsApp e pelo e-mail concierge@primematchimo.com.br, e retornaremos para voce.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-xs uppercase tracking-[0.3em] text-white/60">
                    Atendimento direto: +55 14 99684-5854
                </div>
            </div>

            <template x-if="success">
                <div class="rounded-2xl border border-lux-gold/50 bg-lux-gold/10 px-4 py-3 text-sm text-white/90" x-text="success"></div>
            </template>

            <template x-if="error">
                <div class="rounded-2xl border border-red-400/40 bg-red-500/15 px-4 py-3 text-sm font-medium text-red-200" x-text="error"></div>
            </template>

            <form class="grid gap-4 md:grid-cols-2" @submit.prevent="submit">
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Nome</label>
                    <input type="text" x-model="form.name" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Seu nome completo" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Telefone</label>
                    <input type="tel" x-model="form.phone" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="DDD + WhatsApp" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Cidade</label>
                    <input type="text" x-model="form.city" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Cidade de interesse" />
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Descricao do que procura</label>
                    <textarea x-model="form.description" required rows="4" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Tipologia, budget, vista, bairros, urgencia"></textarea>
                </div>
                <div class="md:col-span-2 flex flex-wrap items-center justify-between gap-3">
                    <p class="text-xs uppercase tracking-[0.25em] text-white/50">Ao enviar, abriremos o WhatsApp com o resumo e confirmaremos o contato.</p>
                    <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]" :disabled="loading">
                        <span x-show="!loading">Enviar briefing</span>
                        <span x-show="loading">Enviando...</span>
                    </button>
                </div>
            </form>
        </section>
</div>
</div>

@include('investor.partials.busca-prime-modal')

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('filtrosInteligentes', () => ({
            timeout: null,
            init() {
                const inputs = this.$el.querySelectorAll('select, input[type="number"]');

                inputs.forEach((input) => {
                    const eventName = input.tagName === 'SELECT' ? 'change' : 'input';

                    input.addEventListener(eventName, () => {
                        clearTimeout(this.timeout);
                        const delay = input.tagName === 'SELECT' ? 200 : 500;
                        this.timeout = setTimeout(() => {
                            if (typeof this.$el.requestSubmit === 'function') {
                                this.$el.requestSubmit();
                            } else {
                                this.$el.submit();
                            }
                        }, delay);
                    });
                });
            },
        }));

        Alpine.data('luxCarousel', () => ({
            track: null,
            handleScroll: null,
            canPrev: false,
            canNext: true,
            scrollAmount: 360,
            init() {
                this.track = this.$refs.track;

                if (!this.track) return;

                this.handleScroll = () => this.updateButtons();
                this.updateButtons();

                this.track.addEventListener('scroll', this.handleScroll);
                window.addEventListener('resize', this.handleScroll);
            },
            updateButtons() {
                if (!this.track) return;

                const maxScroll = this.track.scrollWidth - this.track.clientWidth - 1;
                this.canPrev = this.track.scrollLeft > 0;
                this.canNext = this.track.scrollLeft < maxScroll;
            },
            scrollNext() {
                this.track?.scrollBy({ left: this.scrollAmount, behavior: 'smooth' });
            },
            scrollPrev() {
                this.track?.scrollBy({ left: -this.scrollAmount, behavior: 'smooth' });
            },
            scrollByWheel(event) {
                const horizontal = Math.abs(event.deltaX) >= Math.abs(event.deltaY);

                if (!horizontal) return;

                event.preventDefault();
                this.track?.scrollBy({ left: event.deltaX, behavior: 'smooth' });
            },
        }));

        Alpine.data('investorBriefingForm', () => ({
            form: {
                name: '',
                phone: '',
                city: '',
                description: '',
            },
            success: '',
            error: '',
            loading: false,
            async submit() {
                this.loading = true;
                this.success = '';
                this.error = '';

                try {
                    const response = await fetch('{{ route('investor.custom-request') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            Accept: 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify(this.form),
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        const validation = data?.errors ? Object.values(data.errors)[0]?.[0] : null;
                        this.error = validation ?? data?.message ?? 'Nao foi possivel enviar seu briefing agora. Tente novamente.';
                        return;
                    }

                    this.success = data?.message ?? 'Briefing recebido. Entraremos em contato em instantes.';
                    this.form = { name: '', phone: '', city: '', description: '' };

                    if (data?.whatsapp_url) {
                        window.open(data.whatsapp_url, '_blank');
                    }
                } catch (error) {
                    this.error = 'Nao foi possivel enviar seu briefing agora. Tente novamente.';
                } finally {
                    this.loading = false;
                }
            },
        }));
    });
</script>
@endpush
@endsection

