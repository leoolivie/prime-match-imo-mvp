@extends('layouts.app')

@section('title', 'Oportunidades Prime para Empresários e Investidores')

@push('head')
    <meta name="description" content="Imóveis abaixo do preço, mentores Prime e parceiros estratégicos para acelerar negociações de empresários e investidores." />
    <meta property="og:title" content="Prime Match Imo · Oportunidades Prime" />
    <meta property="og:description" content="Visitas exclusivas, curadoria de mentores e parceiros estratégicos para disputar oportunidades reais." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
@endpush

@php
    use App\Support\ConciergeLink;
    $isInvestor = auth()->check() && auth()->user()->isInvestor();
    $partnerConciergeLink = ConciergeLink::build('oportunidades_prime_parceiros', [], [
        'user_type' => auth()->check() ? auth()->user()->role : null,
        'source' => 'oportunidades_prime_parceiros',
    ]);
@endphp

@section('content')
    <header class="lux-hero">
        <div class="lux-container relative py-24 pb-40 sm:py-28">
            <div class="grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                <div class="space-y-8">
                    <span class="lux-badge-gold">Nova landpage Prime</span>
                    <div>
                        <h1 class="font-poppins text-4xl font-semibold leading-tight text-white sm:text-5xl">
                            Oportunidades Prime para Empresários e Investidores
                        </h1>
                        <p class="mt-4 max-w-2xl text-base text-white/70 sm:text-lg">
                            Imóveis abaixo do preço de mercado, curadoria de mentores e parceiros estratégicos para acelerar suas negociações e visitas com até 10 investidores.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a
                            href="#oportunidades"
                            class="lux-gold-button text-xs uppercase tracking-[0.35em]"
                            data-scroll-target
                            data-filter-type="corporativo"
                        >
                            Sou Empresário Prime
                        </a>
                        <a
                            href="#oportunidades"
                            class="lux-outline-button text-xs uppercase tracking-[0.35em]"
                            data-scroll-target
                            data-filter-type="residencial"
                        >
                            Sou Investidor Prime
                        </a>
                    </div>
                    <p class="max-w-2xl text-sm text-white/60">
                        Conectamos negócios reais com inteligência Prime, visitas exclusivas e suporte especializado em cada etapa da negociação.
                    </p>
                    <div class="grid gap-4 sm:grid-cols-3">
                        @foreach ($heroMetrics as $metric)
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-5 text-white/80 shadow-[0_20px_65px_rgba(0,0,0,0.55)]">
                                <p class="text-xs uppercase tracking-[0.35em] text-white/50">{{ $metric['label'] }}</p>
                                <p class="mt-3 text-2xl font-semibold text-white">{{ $metric['value'] }}</p>
                                <p class="mt-2 text-sm text-white/65">{{ $metric['description'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="relative">
                    <div class="rounded-[32px] border border-lux-gold/30 bg-black/70 p-8 shadow-[0_45px_120px_rgba(203,161,53,0.2)] backdrop-blur-xl">
                        <p class="text-xs uppercase tracking-[0.35em] text-white/50">Agenda limitada</p>
                        <h2 class="mt-4 text-2xl font-semibold text-white">Visitas exclusivas com até 10 investidores</h2>
                        <p class="mt-3 text-sm text-white/70">
                            Selecione oportunidades com tag Destaque Prime para impulsionar campanhas pagas do empresário e liberar alertas VIP para investidores.
                        </p>
                        <ul class="mt-6 space-y-4 text-sm text-white/70">
                            <li class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-lux-gold/20 text-[13px] text-lux-gold">1</span>
                                <span>Diagnóstico com mentores Prime para validar desconto real vs. mercado.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-lux-gold/20 text-[13px] text-lux-gold">2</span>
                                <span>Ativação dos parceiros estratégicos para crédito, seguro e diligência.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-lux-gold/20 text-[13px] text-lux-gold">3</span>
                                <span>Visita com até 10 investidores e concierge conduzindo a disputa.</span>
                            </li>
                        </ul>
                        <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-4 text-xs text-white/70">
                            <p class="font-semibold uppercase tracking-[0.35em] text-white">Lista VIP de investidores</p>
                            <p class="mt-2">Investidores que optam por alertas relâmpago recebem prioridade nas agendas e podem ser ativados pelo empresário como upgrade pago.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="relative bg-[#0B0B0B]">
        <section id="mentores" class="lux-section">
            <div class="lux-container">
                <div class="flex flex-col gap-4 text-center">
                    <span class="lux-badge-gold mx-auto">Autoridade Prime</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Mentores Prime</h2>
                    <p class="mx-auto max-w-2xl text-base text-white/70">Conteúdo de quem vive o mercado imobiliário de alto padrão na prática.</p>
                </div>
                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    @foreach ($mentors as $mentor)
                        <article class="group flex flex-col gap-4 rounded-3xl border border-white/10 bg-[#111111] p-6 text-white/80 shadow-[0_30px_80px_rgba(0,0,0,0.5)] transition hover:-translate-y-1 hover:border-lux-gold/60">
                            <div class="flex items-center gap-4">
                                <img src="{{ $mentor['avatar_url'] }}" alt="{{ $mentor['name'] }}" class="h-16 w-16 rounded-2xl border border-white/10 bg-white/5 object-cover" />
                                <div>
                                    <h3 class="text-lg font-semibold text-white">{{ $mentor['name'] }}</h3>
                                    <p class="text-sm uppercase tracking-[0.3em] text-white/50">{{ $mentor['role'] }}</p>
                                </div>
                            </div>
                            <p class="text-sm text-white/70">{{ $mentor['description'] }}</p>
                            <a href="{{ $mentor['youtube_url'] }}" target="_blank" rel="noopener" class="flex items-center gap-2 text-sm font-semibold text-lux-gold transition hover:text-white">
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-lux-gold/40 bg-lux-gold/10">▶</span>
                                Assistir mentoria
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="parceiros" class="lux-section border-y border-white/5 bg-[#101010]">
            <div class="lux-container">
                <div class="flex flex-col gap-4 text-center">
                    <span class="lux-badge-gold mx-auto">Ecossistema</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Parceiros Prime</h2>
                    <p class="mx-auto max-w-2xl text-base text-white/70">Empresas que potencializam resultados em cada etapa da negociação.</p>
                </div>
                <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    @foreach ($partners as $partner)
                        <article class="flex flex-col gap-4 rounded-3xl border border-white/10 bg-[#0C0C0C] p-6 text-white/70 shadow-[0_25px_70px_rgba(0,0,0,0.55)]">
                            <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="h-12 w-12 rounded-2xl border border-white/5 bg-white/5 object-cover" />
                            <div>
                                <h3 class="text-lg font-semibold text-white">{{ $partner['name'] }}</h3>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $partner['category'] }}</p>
                            </div>
                            <p class="text-sm">{{ $partner['description'] }}</p>
                        </article>
                    @endforeach
                </div>
                <div class="mt-12 rounded-3xl border border-white/10 bg-white/5 p-8 text-center text-white/80">
                    <p class="text-sm uppercase tracking-[0.35em] text-white/50">Novo parceiro?</p>
                    <h3 class="mt-3 text-2xl font-semibold text-white">Quer ser parceiro da Prime Match Imo?</h3>
                    <p class="mt-3 text-sm text-white/65">Se sua empresa ajuda empresários e investidores a fecharem melhores negócios, fale com o concierge para integrar ao ecossistema Prime.</p>
                    <a href="{{ $partnerConciergeLink }}" target="_blank" rel="noopener" class="mt-6 inline-flex items-center justify-center rounded-full border border-lux-gold/40 bg-lux-gold/10 px-8 py-3 text-xs font-semibold uppercase tracking-[0.35em] text-lux-gold transition hover:border-lux-gold hover:bg-lux-gold hover:text-black">
                        Falar com o concierge
                    </a>
                </div>
            </div>
        </section>

        <section id="oportunidades" class="lux-section">
            <div class="lux-container">
                <div class="flex flex-col gap-4 text-center">
                    <span class="lux-badge-gold mx-auto">Curadoria ativa</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Imóveis abaixo do preço de mercado</h2>
                    <p class="mx-auto max-w-2xl text-base text-white/70">Visitas exclusivas com até 10 investidores para disputar oportunidades únicas.</p>
                </div>
                <div class="mt-10 grid gap-4 rounded-3xl border border-white/5 bg-[#0F0F0F] p-6 text-white/70 md:grid-cols-3">
                    <label class="flex flex-col gap-2 text-sm">
                        <span class="text-xs uppercase tracking-[0.35em] text-white/40">Cidade</span>
                        <select class="lux-select" data-opportunity-filter data-filter-key="city">
                            <option value="">Todas</option>
                            @foreach ($cityFilters as $city)
                                <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="flex flex-col gap-2 text-sm">
                        <span class="text-xs uppercase tracking-[0.35em] text-white/40">Faixa de valor</span>
                        <select class="lux-select" data-opportunity-filter data-filter-key="range">
                            <option value="">Todas</option>
                            @foreach ($rangeFilters as $range)
                                <option value="{{ $range['value'] }}">{{ $range['label'] }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="flex flex-col gap-2 text-sm">
                        <span class="text-xs uppercase tracking-[0.35em] text-white/40">Tipo</span>
                        <select class="lux-select" data-opportunity-filter data-filter-key="type">
                            <option value="">Todos</option>
                            @foreach ($typeFilters as $type)
                                <option value="{{ $type['value'] }}">{{ $type['label'] }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="mt-10 grid gap-6 lg:grid-cols-2">
                    @foreach ($opportunities as $opportunity)
                        @php
                            $isPremium = $opportunity['premium'] ?? false;
                            $slots = max($opportunity['slots_total'], 1);
                            $percent = (int) round(($opportunity['slots_taken'] / $slots) * 100);
                            $payload = [
                                'title' => $opportunity['title'],
                                'location' => $opportunity['location'],
                                'asking_price' => $opportunity['asking_price'],
                                'market_price' => $opportunity['market_price'],
                            ];
                            $ctaLink = $isInvestor
                                ? ConciergeLink::build('oportunidades_prime', $payload, [
                                    'user_type' => 'investidor',
                                    'source' => 'oportunidades_prime',
                                ])
                                : route('register', ['profile' => 'investor', 'source' => 'oportunidades-prime', 'opportunity' => $opportunity['slug']]);
                        @endphp
                        <article
                            class="relative overflow-hidden rounded-3xl border border-white/10 bg-[#101010] p-6 text-white/80 shadow-[0_35px_100px_rgba(0,0,0,0.55)] transition hover:-translate-y-1 hover:border-lux-gold/60"
                            data-opportunity-card
                            data-city="{{ $opportunity['city'] }}"
                            data-range="{{ $opportunity['value_range'] }}"
                            data-type="{{ $opportunity['asset_type'] }}"
                        >
                            <div class="flex flex-wrap items-center gap-2">
                                @if ($isPremium)
                                    <span class="lux-badge-gold">Destaque Prime</span>
                                @endif
                                @if ($opportunity['vip_only'])
                                    <span class="lux-badge-outline">Lista VIP</span>
                                @endif
                                <span class="rounded-full border border-white/10 px-4 py-1 text-[11px] uppercase tracking-[0.35em] text-white/60">{{ $opportunity['asset_label'] }}</span>
                            </div>
                            <div class="mt-5 space-y-4">
                                <img src="{{ $opportunity['image'] }}" alt="{{ $opportunity['title'] }}" class="h-56 w-full rounded-2xl border border-white/5 bg-white/5 object-cover" />
                                <div>
                                    <h3 class="text-2xl font-semibold text-white">{{ $opportunity['title'] }}</h3>
                                    <p class="text-sm uppercase tracking-[0.35em] text-white/50">{{ $opportunity['location'] }}</p>
                                </div>
                                <p class="text-sm text-white/70">{{ $opportunity['description'] }}</p>
                                <div class="grid gap-4 rounded-2xl border border-white/5 bg-[#0B0B0B] p-4 text-sm sm:grid-cols-2">
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.35em] text-white/50">Valor pedido</p>
                                        <p class="text-lg font-semibold text-white">{{ $opportunity['asking_price'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.35em] text-white/50">Valor de mercado</p>
                                        <p class="text-lg font-semibold text-white/80">{{ $opportunity['market_price'] }}</p>
                                        <span class="text-xs text-lux-gold">Abaixo ~{{ $opportunity['discount_percentage'] }}%</span>
                                    </div>
                                </div>
                                <div class="space-y-2 rounded-2xl border border-white/5 bg-[#0B0B0B] p-4 text-sm">
                                    <div class="flex flex-wrap items-center justify-between gap-3 text-white/70">
                                        <span>Visita exclusiva para até 10 investidores</span>
                                        <span class="text-xs uppercase tracking-[0.35em] text-white/40">{{ $opportunity['visit_date'] }}</span>
                                    </div>
                                    <div class="h-2 rounded-full bg-white/10">
                                        <div class="h-full rounded-full bg-lux-gold" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <p class="text-xs uppercase tracking-[0.35em] text-white/50">Vagas restantes: {{ $opportunity['slots_total'] - $opportunity['slots_taken'] }}/{{ $opportunity['slots_total'] }}</p>
                                </div>
                                <div class="flex flex-wrap items-center justify-between gap-3 text-xs text-white/60">
                                    <span>Filtro rápido: {{ $opportunity['value_range_label'] }}</span>
                                    <span>{{ $opportunity['partner_highlight'] }}</span>
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    @if ($isInvestor)
                                        <a href="{{ $ctaLink }}" target="_blank" rel="noopener" class="lux-gold-button flex-1 text-xs uppercase tracking-[0.35em] text-center">
                                            Quero disputar essa oportunidade
                                        </a>
                                    @else
                                        <a href="{{ $ctaLink }}" class="lux-gold-button flex-1 text-xs uppercase tracking-[0.35em] text-center">
                                            Quero disputar essa oportunidade
                                        </a>
                                    @endif
                                    <span class="inline-flex items-center rounded-full border border-white/10 px-4 py-2 text-[11px] uppercase tracking-[0.35em] text-white/50">{{ $opportunity['profile_focus'] === 'businessman' ? 'Empresário' : 'Investidor' }} focus</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div data-empty-state class="mt-10 hidden rounded-3xl border border-white/10 bg-[#0F0F0F] p-8 text-center text-white/70">
                    Nenhuma oportunidade corresponde aos filtros escolhidos. Ajuste os filtros para visualizar novas disputas.
                </div>
            </div>
        </section>

        <section id="dicas" class="lux-section border-t border-white/5 bg-[#101010]">
            <div class="lux-container">
                <div class="flex flex-col gap-4 text-center">
                    <span class="lux-badge-gold mx-auto">Conteúdo Premium</span>
                    <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Dicas de Mercado</h2>
                    <p class="mx-auto max-w-2xl text-base text-white/70">Insights rápidos para empresários e investidores que querem decidir com inteligência.</p>
                </div>
                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    @foreach ($insights as $insight)
                        <article class="flex flex-col gap-4 rounded-3xl border border-white/10 bg-[#0B0B0B] p-6 text-white/75">
                            <h3 class="text-xl font-semibold text-white">{{ $insight['title'] }}</h3>
                            <p class="text-sm text-white/70">{{ $insight['summary'] }}</p>
                            <a href="{{ $insight['url'] }}" class="text-sm font-semibold text-lux-gold transition hover:text-white">Ver dica completa →</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="lead" class="lux-section">
            <div class="lux-container">
                <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                    <div class="space-y-5 text-white/80">
                        <span class="lux-badge-gold">Lead quente</span>
                        <h2 class="font-poppins text-3xl font-semibold text-white sm:text-4xl">Quer receber oportunidades Prime antes de todo mundo?</h2>
                        <p class="text-base text-white/70">Cadastre-se para receber alertas de imóveis abaixo do preço, visitas exclusivas e conteúdos dos mentores Prime.</p>
                        <ul class="space-y-3 text-sm text-white/70">
                            <li>➤ Receba o selo VIP e tenha prioridade nas visitas.</li>
                            <li>➤ Empresários podem impulsionar seu imóvel com Destaque Prime.</li>
                            <li>➤ Conte com concierge e parceiros em cada etapa.</li>
                        </ul>
                    </div>
                    <div class="rounded-3xl border border-white/10 bg-[#0F0F0F] p-8 text-white/80 shadow-[0_35px_100px_rgba(0,0,0,0.55)]">
                        @if (session('lead_success'))
                            <div class="mb-4 rounded-2xl border border-lux-gold/40 bg-lux-gold/10 p-4 text-sm text-lux-gold">
                                {{ session('lead_success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('landing.opportunities.leads.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label for="lead_name" class="lux-form-label">Nome</label>
                                <input type="text" id="lead_name" name="name" class="lux-input" value="{{ old('name') }}" required />
                                @error('name')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="lead_email" class="lux-form-label">E-mail</label>
                                <input type="email" id="lead_email" name="email" class="lux-input" value="{{ old('email') }}" required />
                                @error('email')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="lead_phone" class="lux-form-label">Telefone/WhatsApp</label>
                                <input type="text" id="lead_phone" name="phone" class="lux-input" value="{{ old('phone') }}" required />
                                @error('phone')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="lead_profile" class="lux-form-label">Tipo de perfil</label>
                                <select id="lead_profile" name="profile_type" class="lux-select" required>
                                    <option value="">Selecione</option>
                                    <option value="investor" @selected(old('profile_type') === 'investor')>Sou Investidor</option>
                                    <option value="businessman" @selected(old('profile_type') === 'businessman')>Sou Empresário</option>
                                </select>
                                @error('profile_type')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <label class="flex items-start gap-3 text-sm text-white/70">
                                <input type="checkbox" name="vip_opt_in" value="1" class="mt-1 h-4 w-4 rounded border-white/20 bg-transparent" @checked(old('vip_opt_in')) />
                                <span>Quero receber alertas VIP de oportunidades abaixo do preço.</span>
                            </label>
                            <button type="submit" class="w-full lux-gold-button text-xs uppercase tracking-[0.35em]">
                                Quero receber oportunidades
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filters = document.querySelectorAll('[data-opportunity-filter]');
            const cards = document.querySelectorAll('[data-opportunity-card]');
            const emptyState = document.querySelector('[data-empty-state]');

            const applyFilters = () => {
                const activeFilters = {};
                filters.forEach((filter) => {
                    const value = filter.value;
                    if (value) {
                        activeFilters[filter.dataset.filterKey] = value;
                    }
                });

                let visibleCount = 0;
                cards.forEach((card) => {
                    let visible = true;
                    Object.keys(activeFilters).forEach((key) => {
                        if (card.dataset[key] !== activeFilters[key]) {
                            visible = false;
                        }
                    });

                    card.classList.toggle('hidden', !visible);
                    if (visible) {
                        visibleCount += 1;
                    }
                });

                if (emptyState) {
                    emptyState.classList.toggle('hidden', visibleCount !== 0);
                }
            };

            filters.forEach((filter) => filter.addEventListener('change', applyFilters));

            document.querySelectorAll('[data-scroll-target]').forEach((button) => {
                button.addEventListener('click', (event) => {
                    event.preventDefault();
                    const target = document.querySelector('#oportunidades');
                    target?.scrollIntoView({ behavior: 'smooth' });
                    const type = button.dataset.filterType;
                    if (type) {
                        const typeFilter = document.querySelector('[data-filter-key="type"]');
                        if (typeFilter) {
                            typeFilter.value = type;
                            typeFilter.dispatchEvent(new Event('change'));
                        }
                    }
                });
            });
        });
    </script>
@endpush
