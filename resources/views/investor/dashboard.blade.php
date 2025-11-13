@extends('layouts.app')

@section('title', 'Dashboard do Investidor Prime')

@section('content')
@include('components.prime-featured-section', [
    'featured' => $featuredProperties,
    'title' => 'Vitrine Prime do Investidor',
    'subtitle' => 'Os 16 imóveis curados pelo Master aparecem primeiro para acelerar suas análises.',
])

<div class="py-12">
    <div class="lux-container space-y-16">
        <header class="lux-card-dark">
            <div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-5">
                    <span class="lux-badge-gold">Investidor prime</span>
                    <div class="space-y-4">
                        <h1 class="font-poppins text-4xl font-semibold text-white">Bem-vindo ao seu cockpit cinematográfico</h1>
                        <p class="max-w-2xl text-white/70">Acompanhe matches IA, negociações e watchlist em um layout premium com filtros inteligentes, concierge instantâneo e métricas em tempo real.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('investor.search') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Nova busca prime</a>
                        <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, gostaria de revisar minhas recomendações.') }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Falar com concierge</a>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Matches IA</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($metrics['matches']) }}</span>
                        <span class="text-white/40">Atualizado em tempo real</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Negociações</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($metrics['negotiations']) }}</span>
                        <span class="text-white/40">Em andamento</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Watchlist</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($metrics['searches']) }}</span>
                        <span class="text-white/40">Alertas ativos</span>
                    </div>
                </div>
            </div>
        </header>

        <section class="grid gap-8 lg:grid-cols-2">
            <div class="lux-card-dark">
                <h3 class="text-lg font-semibold text-white">Provas sociais</h3>
                <ul class="mt-4 space-y-4 text-sm text-white/60">
                    @foreach($searches as $search)
                        <li class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <div class="flex items-center justify-between">
                                <span>{{ ucfirst($search->property_type ?? 'Qualquer tipologia') }}</span>
                                <span class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $search->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-2 text-xs uppercase tracking-[0.3em] text-white/40">{{ $search->city ?: 'Todas as cidades' }} {{ $search->state ? '• ' . $search->state : '' }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="lux-card-dark">
                <h3 class="text-lg font-semibold text-white">Concierge</h3>
                <p class="mt-2 text-sm text-white/60">Todas as interações registram intenção automaticamente e abrem o canal apropriado preenchendo os dados do investidor.</p>
                <div class="mt-4 grid gap-3">
                    <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, preciso de suporte para avançar em uma negociação.') }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">WhatsApp concierge</a>
                    <a href="tel:+5514996845854" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Telefone</a>
                    <a href="mailto:concierge@primematchimo.com.br" class="lux-outline-button text-xs uppercase tracking-[0.3em]">E-mail</a>
                </div>
            </div>
        </section>

        <section class="lux-card-dark space-y-8">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="space-y-2">
                    <h2 class="text-2xl font-semibold text-white">Filtros prime</h2>
                    <p class="text-sm text-white/60">Filtre por cidade, tipologia e faixa de valor. Resultados alimentam a IA e atualizam a watchlist automaticamente.</p>
                </div>
                <span class="lux-badge-outline">Busca ativa</span>
            </div>
            <form method="GET" action="{{ route('investor.dashboard') }}" class="grid gap-4 md:grid-cols-4">
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Cidade</label>
                    <select name="city" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                        <option value="todas">Todas</option>
                        @foreach($propertyFilters as $city)
                            <option value="{{ $city }}" @selected(request('city') === $city)>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Tipologia</label>
                    <select name="type" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                        <option value="todas">Todas</option>
                        @foreach(['apartment' => 'Apartamento', 'house' => 'Casa', 'commercial' => 'Comercial', 'land' => 'Terreno', 'other' => 'Outro'] as $type => $label)
                            <option value="{{ $type }}" @selected(request('type') === $type)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Faixa de valor</label>
                    <select name="value_range" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                        <option value="todas">Todas</option>
                        <option value="ate-1m" @selected(request('value_range') === 'ate-1m')>Até R$ 1M</option>
                        <option value="1-5m" @selected(request('value_range') === '1-5m')>R$ 1M - R$ 5M</option>
                        <option value="5-10m" @selected(request('value_range') === '5-10m')>R$ 5M - R$ 10M</option>
                        <option value="10m+" @selected(request('value_range') === '10m+')>Acima de R$ 10M</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full rounded-2xl bg-lux-gold py-3 text-sm font-semibold text-lux-black shadow-lux-glow transition hover:-translate-y-0.5">Aplicar filtros</button>
                </div>
            </form>
        </section>

        <section class="space-y-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-white">Recomendações ativas</h2>
                <span class="lux-badge-outline">{{ $properties->total() }} oportunidades</span>
            </div>
            <div class="lux-grid-cards">
                @forelse($properties as $property)
                    <article class="lux-property-card">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $property->city }} • {{ $property->state }}</p>
                                <h3 class="mt-2 text-xl font-semibold text-white">{{ $property->title }}</h3>
                            </div>
                            <span class="lux-property-status text-white/70">{{ ucfirst($property->status) }}</span>
                        </div>
                        <p class="text-sm text-white/60">{{ \Illuminate\Support\Str::limit($property->description, 160) }}</p>
                        <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</p>
                                <p class="mt-1 text-lg font-semibold text-white">R$ {{ number_format($property->price, 2, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Dorms</p>
                                <p class="mt-1 text-lg font-semibold text-white">{{ $property->bedrooms ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Banheiros</p>
                                <p class="mt-1 text-lg font-semibold text-white">{{ $property->bathrooms ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Área</p>
                                <p class="mt-1 text-lg font-semibold text-white">{{ $property->area ? number_format($property->area, 0, ',', '.') . ' m²' : '—' }}</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <form method="POST" action="{{ route('investor.lead.concierge', $property) }}" target="_blank">
                                @csrf
                                <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com concierge</button>
                            </form>
                            <form method="POST" action="{{ route('investor.lead.create', $property) }}">
                                @csrf
                                <button type="submit" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Registrar interesse</button>
                            </form>
                            <a href="mailto:concierge@primematchimo.com.br?subject={{ rawurlencode('Dossiê do imóvel ' . $property->title) }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Solicitar dossiê</a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                        Nenhuma oportunidade encontrada com os filtros selecionados. Ajuste os filtros ou fale com nosso concierge prime.
                    </div>
                @endforelse
            </div>
            <div>
                {{ $properties->links() }}
            </div>
        </section>

        <section class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="lux-card-dark">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Negociações e matches recentes</h2>
                    <span class="lux-badge-outline">Pipeline concierge</span>
                </div>
                <div class="mt-6 space-y-4">
                    @forelse($leads as $lead)
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <h3 class="text-lg font-semibold text-white">{{ $lead->property->title }}</h3>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $lead->property->city }} • {{ $lead->property->state }}</p>
                                </div>
                                <span class="lux-property-status text-white/70">{{ ucfirst($lead->status) }}</span>
                            </div>
                            <p class="mt-3 text-sm text-white/60">{{ \Illuminate\Support\Str::limit($lead->property->description, 140) }}</p>
                            <div class="mt-4 flex flex-wrap gap-3 text-xs text-white/50">
                                <span>Valor: R$ {{ number_format($lead->property->price, 2, ',', '.') }}</span>
                                @if($lead->primeBroker)
                                    <span>Concierge: {{ $lead->primeBroker->name }}</span>
                                @endif
                                <span>Atualizado {{ $lead->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-white/60">Você ainda não possui negociações ativas. Explore as recomendações e acione o concierge para iniciar novas oportunidades.</p>
                    @endforelse
                </div>
                <div class="mt-6">
                    {{ $leads->links() }}
                </div>
            </div>
            <div class="space-y-6">
                <div class="lux-card-dark">
                    <h3 class="text-lg font-semibold text-white">Tendências da curadoria</h3>
                    <ul class="mt-4 space-y-3 text-sm text-white/60">
                        <li>• Corporate AAA com contratos longos e reajuste IPCA seguem em alta.</li>
                        <li>• Produtos hospitality com concierge completo entregam ROI médio de 16% a.a.</li>
                        <li>• Segmento agro premium com dossiê ambiental ganhou demanda na última semana.</li>
                    </ul>
                </div>
                <div class="lux-card-dark">
                    <h3 class="text-lg font-semibold text-white">Dicas prime</h3>
                    <p class="mt-2 text-sm text-white/60">Personalize alertas por faixa de valor e perfil de risco. Quanto mais você interage, mais a IA calibrada pelo concierge adapta suas recomendações.</p>
                </div>
                <div class="lux-card-dark">
                    <h3 class="text-lg font-semibold text-white">Histórico de buscas</h3>
                    <ul class="mt-4 space-y-3 text-sm text-white/60">
                        @foreach($searches->take(3) as $search)
                            <li>• {{ ucfirst($search->property_type ?? 'Qualquer') }} em {{ $search->city ?: 'todas as cidades' }} {{ $search->state ? '(' . $search->state . ')' : '' }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
