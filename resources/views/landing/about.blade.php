@extends('layouts.app')

@section('title', 'Prime Match Imo — Quem Somos')
@section('meta')
    <meta name="description" content="Prime Match Imo — plataforma de matchmaking imobiliário premium com concierge humano + IA. Conheça como conectamos investidores e empresários prime com exclusividade e segurança.">
@endsection

@section('content')
@php
    use App\Support\ConciergeLink;
@endphp

<section class="lux-hero">
    <div class="lux-container py-16 lg:py-24">
        <div class="space-y-10">
            <div class="space-y-4">
                <span class="lux-badge-gold">Plataforma de matchmaking premium</span>
                <span class="lux-badge-outline">Não somos imobiliária — somos ponte segura e curada</span>
                <h1 class="font-poppins text-4xl font-semibold leading-tight text-white sm:text-5xl">Quem Somos — Prime Match Imo</h1>
                <p class="max-w-3xl text-base text-white/75 sm:text-lg">
                    Somos uma plataforma exclusiva de matchmaking imobiliário premium.
                    Conectamos investidores de alto padrão a imóveis únicos de empresários prime, com curadoria humana + IA e acompanhamento do Concierge Prime.
                    Não somos imobiliária. Não anunciamos imóveis em massa. Fazemos o match certo, com segurança e discrição.
                </p>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('investor.catalog') }}" class="lux-gold-button inline-flex items-center text-xs uppercase tracking-[0.3em]" aria-label="Ir para a vitrine do investidor">
                    Sou Investidor Prime
                </a>
                <a href="{{ route('landing.businessman') }}" class="lux-outline-button inline-flex items-center text-xs uppercase tracking-[0.3em]" aria-label="Ir para a página de empresários prime">
                    Sou Empresário Prime
                </a>
                <a href="{{ ConciergeLink::build('investidor_card', ['city' => 'Concierge Prime', 'type' => 'matchmaking premium'], ['user_type' => 'investidor', 'source' => 'about']) }}" target="_blank" rel="noopener" class="lux-outline-button inline-flex items-center text-xs uppercase tracking-[0.3em]" aria-label="Falar com o Concierge via WhatsApp">
                    Falar com Concierge
                </a>
            </div>
        </div>
    </div>
</section>

<section class="lux-section">
    <div class="lux-container">
        <div class="lux-card-dark space-y-4">
            <span class="lux-badge-outline">O que fazemos</span>
            <h2 class="text-3xl font-semibold text-white">O que é a Prime Match Imo?</h2>
            <p class="text-base text-white/70">
                A Prime Match Imo é um sistema de intermediação curada para o mercado de alto padrão.
                Em vez de um catálogo infinito, você entra em uma rede privada de imóveis e investidores qualificados, onde cada oportunidade é analisada e acompanhada por um concierge dedicado.
            </p>
        </div>
    </div>
</section>

<section class="lux-section">
    <div class="lux-container space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-3xl font-semibold text-white">Para quem é</h2>
            <span class="lux-badge-outline">Duas jornadas, um concierge</span>
        </div>
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="lux-card-dark space-y-4">
                <h3 class="text-2xl font-semibold text-white">Investidor Prime</h3>
                <ul class="space-y-2 text-white/70">
                    <li>• Acesso a imóveis exclusivos e off-market</li>
                    <li>• Curadoria rígida (humana + IA) antes de chegar até você</li>
                    <li>• Dossiê completo e atendimento concierge dedicado</li>
                    <li>• Segurança: empresários analisados por compliance</li>
                    <li>• Benefícios com parceiros Prime para aquisição</li>
                </ul>
            </div>
            <div class="lux-card-dark space-y-4">
                <h3 class="text-2xl font-semibold text-white">Empresário Prime</h3>
                <ul class="space-y-2 text-white/70">
                    <li>• Cadastro de até 50 imóveis sem custo inicial</li>
                    <li>• Seus imóveis são exclusivos, sem duplicidade na plataforma</li>
                    <li>• Acesso a investidores realmente qualificados</li>
                    <li>• Concierge único conduzindo follow-ups e negociações</li>
                    <li>• Contrato de prestação de serviço garantindo exclusividade</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="lux-section">
    <div class="lux-container space-y-8">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-3xl font-semibold text-white">Como funciona</h2>
            <span class="lux-badge-outline">Intermediação curada</span>
        </div>
        <div class="grid gap-5 lg:grid-cols-3">
            <div class="lux-card-dark space-y-3">
                <div class="lux-badge-gold inline-flex">Passo 1</div>
                <h3 class="text-xl font-semibold text-white">Cadastro/Exploração</h3>
                <p class="text-sm text-white/70">Empresários cadastram imóveis premium com fotos, ficha técnica e documentos. Investidores exploram oportunidades alinhadas ao seu perfil.</p>
            </div>
            <div class="lux-card-dark space-y-3">
                <div class="lux-badge-gold inline-flex">Passo 2</div>
                <h3 class="text-xl font-semibold text-white">Concierge Prime</h3>
                <p class="text-sm text-white/70">Ao clicar em “Falar com o Concierge”, o investidor entra direto no WhatsApp. O concierge entende o objetivo e filtra as oportunidades ideais.</p>
            </div>
            <div class="lux-card-dark space-y-3">
                <div class="lux-badge-gold inline-flex">Passo 3</div>
                <h3 class="text-xl font-semibold text-white">Intermediação assistida (War Room)</h3>
                <p class="text-sm text-white/70">O concierge organiza dossiê, visitas, propostas e diligência. Tudo com discrição, agilidade e acompanhamento até o fechamento.</p>
            </div>
        </div>
    </div>
</section>

<section class="lux-section">
    <div class="lux-container space-y-8">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-3xl font-semibold text-white">Nossos diferenciais</h2>
            <span class="lux-badge-outline">Segurança e exclusividade</span>
        </div>
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            <div class="lux-card-dark space-y-3">
                <h3 class="text-xl font-semibold text-white">Exclusividade real</h3>
                <p class="text-sm text-white/70">Imóvel cadastrado é único. Sem repetição, sem disputa de anúncio.</p>
            </div>
            <div class="lux-card-dark space-y-3">
                <h3 class="text-xl font-semibold text-white">Curadoria humana + IA</h3>
                <p class="text-sm text-white/70">Filtro técnico e estratégico antes do imóvel chegar ao investidor.</p>
            </div>
            <div class="lux-card-dark space-y-3">
                <h3 class="text-xl font-semibold text-white">Concierge Prime 24/7</h3>
                <p class="text-sm text-white/70">Um único ponto de contato conduzindo toda a negociação.</p>
            </div>
            <div class="lux-card-dark space-y-3">
                <h3 class="text-xl font-semibold text-white">Segurança e discrição</h3>
                <p class="text-sm text-white/70">Rede validada e comunicação em canal seguro.</p>
            </div>
        </div>
    </div>
</section>

<section class="lux-section">
    <div class="lux-container">
        <div class="lux-card-dark space-y-6 text-center">
            <span class="lux-badge-outline mx-auto">Manifesto</span>
            <h2 class="text-3xl font-semibold text-white">Seu tempo é o ativo mais valioso</h2>
            <p class="mx-auto max-w-3xl text-base text-white/70">
                No alto padrão, não basta “ver imóveis”.
                Você precisa do imóvel certo, com o investidor certo, no momento certo.
                A Prime Match Imo existe para simplificar esse caminho com curadoria, exclusividade e concierge dedicado.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('investor.catalog') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Investidor</a>
                <a href="{{ route('landing.businessman') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Empresário</a>
            </div>
        </div>
    </div>
</section>
@endsection
