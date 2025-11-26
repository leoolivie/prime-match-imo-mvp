@extends('layouts.app')

@php
    use Illuminate\Support\Str;

    // Variáveis originais
    $heroImage = $galleryImages->first() ?? asset('images/placeholders/luxury-property.svg');
    $hasVideo = filled($property->video_url);
    $videoUrl = $property->video_url;
    $whatsappBase = 'https://wa.me/5514999999999';
    
    // Novas variáveis para o foco em Investidor (Assumindo que serão passadas para a view)
    $investment_tagline = $investment_tagline ?? 'Segurança patrimonial e potencial de valorização de 15% em 3 anos, comprovado por dados de mercado.';
    $cap_rate_estimated = $cap_rate_estimated ?? '8.5'; // Exemplo: 8.5%
    $valorization_potential = $valorization_potential ?? '15'; // Exemplo: 15%
    $liquidity_data = $liquidity_data ?? 'Bairro com valorização média de 12% a.a. nos últimos 5 anos.';
    $replacement_cost_premium = $replacement_cost_premium ?? 'Acabamentos e projeto que garantem um custo de reposição 30% superior ao valor de mercado.';
    $asset_management_occupancy = $asset_management_occupancy ?? 'Estrutura de gestão de locação premium disponível, com taxa de ocupação histórica de 95%.';
    
    // CTAs focados em Investimento
    $ctaMessage = urlencode("Quero a Análise de Viabilidade Financeira do ativo {$property->title}");
    $dossierMessage = urlencode("Solicito acesso ao Data Room completo do ativo {$property->title}");
    
    $type = $property->type ?? 'Ativo Patrimonial';
    $cityState = collect([$property->city ?? null, $property->state ?? null])->filter()->implode(' • ');
@endphp

@section('title', ('Ativo Imobiliário: ' . ($property->title ?? 'Imóvel Prime')) . ' - Prime Match')

@section('content')
<main class="min-h-screen bg-neutral-950 text-white">
    {{-- Hero - Otimizado para Investidor --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-neutral-950 via-black to-neutral-900">
        <div class="absolute inset-0 opacity-60 blur-3xl" style="background: radial-gradient(circle at 20% 20%, rgba(203,161,53,0.18), transparent 30%), radial-gradient(circle at 80% 10%, rgba(255,255,255,0.08), transparent 35%);"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-14 lg:py-18">
            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div class="space-y-5">
                    <div class="inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs uppercase tracking-[0.35em] text-white/70">
                        <span class="text-[11px] font-semibold">Ativo Imobiliário</span>
                        @if($cityState)<span class="text-white/50">{{ $cityState }}</span>@endif
                    </div>
                    {{-- Título focado em Ativo Patrimonial --}}
                    <h1 class="font-poppins text-4xl font-semibold leading-tight sm:text-5xl">Ativo Imobiliário de Alto Rendimento: {{ $property->title }}</h1>
                    
                    {{-- Subtítulo focado em Investimento --}}
                    <p class="text-lg text-white/70">{{ $investment_tagline }}</p>
                    
                    <div class="flex flex-wrap items-center gap-3">
                        @if($priceFormatted)
                            {{-- Preço como Valor de Mercado --}}
                            <span class="rounded-2xl bg-gradient-to-r from-yellow-400/20 via-yellow-500/20 to-yellow-300/20 px-4 py-2 text-2xl font-semibold text-yellow-200 shadow-[0_10px_40px_rgba(203,161,53,0.3)]">{{ $priceFormatted }}</span>
                        @endif
                        
                        {{-- Novos Chips de Métricas de Investimento --}}
                        <div class="flex flex-wrap gap-2 text-xs uppercase tracking-[0.3em] text-white/70">
                            @if($cap_rate_estimated)
                                <span class="rounded-full border border-yellow-300/30 bg-yellow-300/10 px-3 py-1 text-yellow-300 font-semibold">Cap Rate Est.: {{ $cap_rate_estimated }}%</span>
                            @endif
                            @if($valorization_potential)
                                <span class="rounded-full border border-yellow-300/30 bg-yellow-300/10 px-3 py-1 text-yellow-300 font-semibold">Valorização Pot.: {{ $valorization_potential }}%</span>
                            @endif
                            <span class="rounded-full border border-white/10 px-3 py-1">{{ $type }}</span>
                            @if($property->area_privativa ?? $property->area_total)
                                <span class="rounded-full border border-white/10 px-3 py-1">{{ $property->area_privativa ?? $property->area_total }} m²</span>
                            @endif
                        </div>
                    </div>
                    <p class="max-w-2xl text-sm text-white/65">
                        Curadoria Prime para investidores que buscam ativos raros e prontos para receber capital e gerar retorno.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        {{-- CTA Principal: Análise de Viabilidade --}}
                        <a href="{{ $whatsappBase }}?text={{ $ctaMessage }}" target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-300 px-6 py-3 text-xs font-semibold uppercase tracking-[0.35em] text-neutral-900 shadow-[0_20px_60px_rgba(203,161,53,0.35)] transition hover:scale-[1.02]">
                            Solicitar Análise de Viabilidade Financeira
                        </a>
                        {{-- CTA Secundário: Data Room --}}
                        <a href="{{ $whatsappBase }}?text={{ $dossierMessage }}" target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-6 py-3 text-xs font-semibold uppercase tracking-[0.35em] text-white/80 transition hover:border-yellow-300/60 hover:text-white">
                            Acessar Data Room Completo
                        </a>
                    </div>
                </div>

                <div class="relative rounded-3xl border border-white/10 bg-black/60 shadow-[0_25px_80px_rgba(0,0,0,0.5)]">
                    <div class="overflow-hidden rounded-3xl">
                        @if($hasVideo)
                            <div class="relative aspect-video">
                                @if(Str::contains($videoUrl, ['youtube.com', 'youtu.be', 'vimeo.com']))
                                    <iframe src="{{ $videoUrl }}" class="h-full w-full rounded-3xl" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                @else
                                    <video src="{{ Str::startsWith($videoUrl, ['http://', 'https://']) ? $videoUrl : asset($videoUrl) }}" class="h-full w-full rounded-3xl" controls playsinline></video>
                                @endif
                            </div>
                        @else
                            <img src="{{ $heroImage }}" alt="{{ $property->title }}" class="h-full w-full max-h-[500px] rounded-3xl object-cover">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tese de Valorização e Liquidez (Substitui Highlights) --}}
    <section class="bg-neutral-950">
        <div class="mx-auto max-w-6xl px-6 py-12 lg:py-16">
            <div class="grid gap-10 lg:grid-cols-2">
                <div class="space-y-4">
                    <h2 class="text-2xl font-semibold text-white">Tese de Valorização e Liquidez</h2>
                    <p class="text-white/70">Análise de mercado e fatores que garantem a segurança e o retorno do seu capital.</p>
                    <ul class="space-y-3 text-white/80">
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 rounded-full bg-yellow-300"></span>
                            <span>**Liquidez Comprovada:** {{ $liquidity_data }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 rounded-full bg-yellow-300"></span>
                            <span>**Custo de Reposição Elevado:** {{ $replacement_cost_premium }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 rounded-full bg-yellow-300"></span>
                            <span>**Gestão de Ativos Opcional:** {{ $asset_management_occupancy }}</span>
                        </li>
                    </ul>
                </div>
                <div class="rounded-3xl border border-white/10 bg-neutral-900/60 p-6 shadow-lg shadow-black/40">
                    <h3 class="text-xl font-semibold text-white">Descrição do Ativo</h3>
                    <p class="mt-3 text-sm leading-relaxed text-white/75">
                        {{ $property->description ?? 'Documento completo disponível sob demanda. Fale com o consultor para receber o dossiê detalhado e a análise de viabilidade.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Galeria Prime (Mantida) --}}
    <section class="bg-neutral-950">
        <div class="mx-auto max-w-6xl px-6 py-12 lg:py-16 space-y-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-white">Galeria Prime</h2>
                    <p class="text-sm text-white/70">Imagens curadas para evidenciar materiais, volumetria e luz.</p>
                </div>
            </div>
            <div class="relative">
                <div class="flex snap-x snap-mandatory gap-4 overflow-x-auto pb-4">
                    @foreach($galleryImages as $img)
                        <button type="button" class="group relative h-64 w-80 flex-shrink-0 snap-start overflow-hidden rounded-2xl border border-white/10 bg-neutral-900/70 shadow-lg shadow-black/40" onclick="document.dispatchEvent(new CustomEvent('prime-lightbox-open',{detail:{src:'{{ $img }}'}}))">
                            <img src="{{ $img }}" alt="Galeria" class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.04] group-hover:brightness-110">
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Ficha Técnica (Otimizada com Dados Financeiros) --}}
    <section class="bg-neutral-950">
        <div class="mx-auto max-w-6xl px-6 py-12 lg:py-16 space-y-6">
            <h2 class="text-2xl font-semibold text-white">Ficha Técnica do Ativo</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    // Adicionando dados financeiros no topo
                    $specs = [
                        'Valor do Condomínio' => $condo_fee ?? 'Sob Consulta',
                        'IPTU Anual' => $annual_iptu ?? 'Sob Consulta',
                        'Manutenção Estimada' => $estimated_maintenance ?? 'Baixa',
                        'Tipo' => $type,
                        'Área total' => $property->area_total ? $property->area_total . ' m²' : null,
                        'Área privativa' => $property->area_privativa ? $property->area_privativa . ' m²' : null,
                        'Quartos' => $property->bedrooms,
                        'Suítes' => $property->suites,
                        'Banheiros' => $property->bathrooms,
                        'Vagas' => $property->parking_spaces,
                        'Andar' => $property->floor ?? '—',
                        'Posição solar' => $property->sun_position ?? 'Projeto favorece luz natural',
                    ];
                @endphp
                @foreach($specs as $label => $value)
                    @if($value)
                        <div class="rounded-2xl border border-white/10 bg-neutral-900/60 p-4 shadow-md shadow-black/30">
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $label }}</p>
                            <p class="mt-2 text-lg font-semibold text-white">{{ $value }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- Análise de Retorno e Estratégia de Saída (Substitui Tese de Investimento) --}}
    <section class="bg-neutral-950">
        <div class="mx-auto max-w-6xl px-6 py-12 lg:py-16 space-y-4">
            <h2 class="text-2xl font-semibold text-white">Análise de Retorno e Estratégia de Saída (Exit Strategy)</h2>
            <div class="grid gap-4 md:grid-cols-2">
                <div class="rounded-2xl border border-white/10 bg-neutral-900/60 p-5 shadow-md shadow-black/30">
                    <h3 class="text-lg font-semibold text-yellow-300 mb-2">Valorização por Escassez</h3>
                    <p class="text-white/80">A raridade do ativo e a assinatura arquitetônica garantem uma **valorização projetada de {{ $valorization_potential }}%** nos próximos 36 meses, baseada em múltiplos de mercado e escassez de ativos similares na região.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-neutral-900/60 p-5 shadow-md shadow-black/30">
                    <h3 class="text-lg font-semibold text-yellow-300 mb-2">Projeção de Renda (Cap Rate)</h3>
                    <p class="text-white/80">Estratégia de renda flexível: locação de curta temporada (Cap Rate de **{{ $cap_rate_estimated }}% a.a.**) ou contratos corporativos (Cap Rate de 6.0% a.a.). Solicite a modelagem financeira completa.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-neutral-900/60 p-5 shadow-md shadow-black/30">
                    <h3 class="text-lg font-semibold text-yellow-300 mb-2">Demanda Consistente</h3>
                    <p class="text-white/80">Localização em bairro com público alvo de alto ticket, garantindo demanda consistente e serviços premium no entorno, fator chave para a liquidez do ativo.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-neutral-900/60 p-5 shadow-md shadow-black/30">
                    <h3 class="text-lg font-semibold text-yellow-300 mb-2">Due Diligence e Onboarding</h3>
                    <p class="text-white/80">O Consultor Patrimonial acompanha a *due diligence*, negociação e o *onboarding* do ativo na sua carteira, garantindo uma transação segura e eficiente.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Consultoria Patrimonial Exclusiva (Substitui Concierge Prime) --}}
    <section class="bg-gradient-to-r from-black via-neutral-950 to-black">
        <div class="mx-auto max-w-5xl px-6 py-12 lg:py-16 space-y-6 text-center">
            <h3 class="text-2xl font-semibold text-white">Consultoria Patrimonial Exclusiva para Investidores</h3>
            <div class="flex flex-wrap justify-center gap-3 text-sm text-white/75">
                <span class="rounded-full border border-white/15 px-4 py-2">Análise de Due Diligence e Estruturação Jurídica</span>
                <span class="rounded-full border border-white/15 px-4 py-2">Modelagem Financeira e Projeção de ROI Personalizada</span>
                <span class="rounded-full border border-white/15 px-4 py-2">Acesso a Data Room com Documentação Completa</span>
            </div>
            <a href="{{ $whatsappBase }}?text={{ $ctaMessage }}" target="_blank" rel="noopener"
               class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-300 px-8 py-4 text-sm font-semibold uppercase tracking-[0.35em] text-neutral-900 shadow-[0_20px_60px_rgba(203,161,53,0.35)] transition hover:scale-[1.02]">
                Solicitar Análise de Viabilidade Agora
            </a>
        </div>
    </section>
    
    {{-- Seção de Urgência (Mantida, mas com foco em oportunidade) --}}
    <section class="bg-neutral-950">
        <div class="mx-auto max-w-4xl px-6 py-12 text-center space-y-4">
            <h2 class="text-3xl font-semibold text-white">Oportunidade de Investimento Rara</h2>
            <p class="text-lg text-white/70">Ativos com este perfil de retorno e segurança patrimonial são negociados rapidamente. Não perca a chance de incluir este ativo exclusivo em sua carteira.</p>
            <a href="{{ $whatsappBase }}?text={{ $ctaMessage }}" target="_blank" rel="noopener"
               class="inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-6 py-3 text-xs font-semibold uppercase tracking-[0.35em] text-white/80 transition hover:border-yellow-300/60 hover:text-white">
                Garantir Análise de Viabilidade
            </a>
        </div>
    </section>

</main>
@endsection