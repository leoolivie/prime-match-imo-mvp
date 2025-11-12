@extends('layouts.app')

@section('title', 'Prime Match Imo - Conectamos pessoas a imóveis extraordinários')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-[#050B2C] text-white">
        <div class="absolute inset-0 opacity-60" style="background: radial-gradient(circle at top left, rgba(80,130,255,0.35), transparent 40%), radial-gradient(circle at bottom right, rgba(128,90,213,0.35), transparent 45%);"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 border border-white/20 text-sm uppercase tracking-[0.3em]">Matchmaking Imobiliário</span>
                    <h1 class="text-4xl sm:text-5xl xl:text-6xl font-semibold leading-tight">Encontre o imóvel perfeito com a curadoria Prime Match Imo</h1>
                    <p class="text-lg text-white/80 leading-relaxed">
                        Conectamos investidores, empresários e corretores através de uma plataforma inteligente que combina tecnologia avançada e atendimento prime para gerar negócios memoráveis.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 px-8 py-3 text-lg font-semibold text-white shadow-lg shadow-blue-500/30 transition hover:from-indigo-500 hover:to-purple-500">
                            Comece gratuitamente
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-8 py-3 text-lg font-semibold text-white/80 transition hover:border-white hover:text-white">
                            Já sou cliente
                        </a>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6">
                        <div class="glass-card text-left">
                            <div class="text-3xl font-semibold">+1.2k</div>
                            <p class="text-xs uppercase tracking-wide text-white/60">Matches gerados</p>
                        </div>
                        <div class="glass-card text-left">
                            <div class="text-3xl font-semibold">+180M</div>
                            <p class="text-xs uppercase tracking-wide text-white/60">em VGV movimentado</p>
                        </div>
                        <div class="glass-card text-left">
                            <div class="text-3xl font-semibold">24h</div>
                            <p class="text-xs uppercase tracking-wide text-white/60">curadoria dedicada</p>
                        </div>
                        <div class="glass-card text-left">
                            <div class="text-3xl font-semibold">98%</div>
                            <p class="text-xs uppercase tracking-wide text-white/60">satisfação dos clientes</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -top-10 -left-10 h-40 w-40 rounded-full bg-blue-500/40 blur-3xl"></div>
                    <div class="absolute -bottom-16 -right-8 h-48 w-48 rounded-full bg-purple-500/40 blur-3xl"></div>
                    <div class="relative rounded-3xl border border-white/10 bg-white/5 p-8 backdrop-blur-xl shadow-[0_25px_80px_rgba(15,37,101,0.45)]">
                        <div class="flex items-center justify-between border-b border-white/10 pb-6">
                            <div>
                                <p class="text-sm uppercase tracking-[0.3em] text-white/50">Fluxo Prime</p>
                                <h3 class="text-2xl font-semibold">Match Perfeito</h3>
                            </div>
                            <span class="gold-badge">Premium</span>
                        </div>
                        <div class="space-y-6 pt-6">
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-500/30">1</div>
                                <div>
                                    <h4 class="font-semibold">Briefing inteligente</h4>
                                    <p class="text-sm text-white/70">Coletamos seus objetivos de investimento com precisão e segurança.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-500/30">2</div>
                                <div>
                                    <h4 class="font-semibold">Curadoria especializada</h4>
                                    <p class="text-sm text-white/70">Nossa equipe seleciona oportunidades exclusivas alinhadas ao seu perfil.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-500/30">3</div>
                                <div>
                                    <h4 class="font-semibold">Match &amp; negociação</h4>
                                    <p class="text-sm text-white/70">Você recebe um dossiê completo para avançar com segurança.</p>
                                </div>
                            </div>
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 font-semibold text-[#050B2C] transition hover:bg-blue-50">
                                Criar minha conta
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Value Propositions -->
    <section class="relative bg-white py-20">
        <div class="absolute inset-x-0 -top-24 h-24 bg-gradient-to-b from-white/0 to-white"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="gold-badge uppercase tracking-[0.2em]">Experiência 360º</span>
                <h2 class="mt-6 text-4xl font-semibold text-slate-900">Uma jornada completa para cada perfil</h2>
                <p class="mt-4 text-lg text-slate-600 max-w-3xl mx-auto">
                    Do investidor que busca performance ao corretor que deseja amplificar seus resultados, a Prime Match Imo entrega soluções personalizadas e acompanhadas por especialistas.
                </p>
            </div>
            <div class="grid gap-10 lg:grid-cols-3">
                <div class="lux-card">
                    <div class="lux-card-icon bg-blue-500/15 text-blue-600">👤</div>
                    <h3 class="text-2xl font-semibold text-slate-900">Investidores</h3>
                    <p class="mt-4 text-slate-600">Conheça oportunidades com alto potencial, análises completas e suporte consultivo para decisões estratégicas.</p>
                    <ul class="mt-6 space-y-3 text-sm text-slate-500">
                        <li class="flex items-center gap-2"><span class="text-blue-500">▹</span> Alertas inteligentes e personalização total</li>
                        <li class="flex items-center gap-2"><span class="text-blue-500">▹</span> Indicadores de rentabilidade com simulações</li>
                        <li class="flex items-center gap-2"><span class="text-blue-500">▹</span> Curadoria de imóveis prime off-market</li>
                    </ul>
                </div>
                <div class="lux-card">
                    <div class="lux-card-icon bg-emerald-500/15 text-emerald-600">🏢</div>
                    <h3 class="text-2xl font-semibold text-slate-900">Empresários</h3>
                    <p class="mt-4 text-slate-600">Ganhe visibilidade, acompanhe métricas em tempo real e acelere negociações com leads qualificados.</p>
                    <ul class="mt-6 space-y-3 text-sm text-slate-500">
                        <li class="flex items-center gap-2"><span class="text-emerald-500">▹</span> Gestão completa do portfólio de imóveis</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-500">▹</span> Destaques, tours virtuais e materiais exclusivos</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-500">▹</span> Consultoria estratégica para lançamentos</li>
                    </ul>
                </div>
                <div class="lux-card">
                    <div class="lux-card-icon bg-purple-500/15 text-purple-600">🎯</div>
                    <h3 class="text-2xl font-semibold text-slate-900">Corretores Prime</h3>
                    <p class="mt-4 text-slate-600">Amplie sua carteira com clientes verificados e ferramentas digitais para conduzir todo o relacionamento.</p>
                    <ul class="mt-6 space-y-3 text-sm text-slate-500">
                        <li class="flex items-center gap-2"><span class="text-purple-500">▹</span> CRM integrado com alertas em tempo real</li>
                        <li class="flex items-center gap-2"><span class="text-purple-500">▹</span> Comunicações oficiais via WhatsApp e e-mail</li>
                        <li class="flex items-center gap-2"><span class="text-purple-500">▹</span> Métricas de performance e capacitações</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Match Flow -->
    <section class="bg-slate-950 py-20 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">
                <div class="max-w-xl space-y-6">
                    <span class="gold-badge uppercase tracking-[0.3em]">Fluxo Exclusivo</span>
                    <h2 class="text-4xl font-semibold leading-tight">Tecnologia e atendimento humano para um match sem atritos</h2>
                    <p class="text-white/70 leading-relaxed">
                        Cada etapa é construída para entregar confiança e resultados. Nosso painel acompanha você e sua equipe do primeiro contato até a assinatura, com atualizações em tempo real.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="badge-outline">KPI em tempo real</span>
                        <span class="badge-outline">Gestão documental</span>
                        <span class="badge-outline">Suporte dedicado</span>
                    </div>
                </div>
                <div class="relative flex-1">
                    <div class="absolute -inset-6 rounded-3xl bg-gradient-to-br from-blue-500/30 to-indigo-500/20 blur-2xl"></div>
                    <div class="relative space-y-6 rounded-3xl border border-white/10 bg-white/5 p-8 backdrop-blur-xl">
                        <div class="timeline-step">
                            <div class="timeline-index">01</div>
                            <div>
                                <h3 class="text-xl font-semibold">Cadastro &amp; perfil</h3>
                                <p class="text-sm text-white/70">Validação segura dos dados e definição das preferências ou portfólio de imóveis.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="timeline-index">02</div>
                            <div>
                                <h3 class="text-xl font-semibold">Curadoria assistida</h3>
                                <p class="text-sm text-white/70">Equipe prime prepara dossiês personalizados com insights exclusivos.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="timeline-index">03</div>
                            <div>
                                <h3 class="text-xl font-semibold">Match inteligente</h3>
                                <p class="text-sm text-white/70">Integração entre investidores, corretores e empresários com acompanhamento dedicado.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="timeline-index">04</div>
                            <div>
                                <h3 class="text-xl font-semibold">Fechamento prime</h3>
                                <p class="text-sm text-white/70">Suporte jurídico e financeiro até a assinatura, com KPIs pós-venda.</p>
                            </div>
                        </div>
                        <a href="{{ route('register') }}" class="mt-8 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-3 font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:from-indigo-500 hover:to-purple-500">
                            Agendar demonstração
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Plans -->
    <section class="bg-white py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="gold-badge uppercase tracking-[0.3em]">Planos Prime</span>
                <h2 class="mt-6 text-4xl font-semibold text-slate-900">Escolha a intensidade da sua jornada</h2>
                <p class="mt-4 text-lg text-slate-600 max-w-3xl mx-auto">
                    Todos os planos incluem acesso ao ecossistema Prime Match Imo, suporte especializado e métricas que impulsionam decisões inteligentes.
                </p>
            </div>
            <div class="grid gap-10 lg:grid-cols-3">
                <div class="plan-card">
                    <h3 class="text-xl font-semibold text-slate-900">Prime Start</h3>
                    <p class="mt-2 text-sm text-slate-500">Ideal para começar a explorar oportunidades com curadoria estratégica.</p>
                    <div class="mt-6 text-4xl font-semibold text-slate-900">R$ 350<span class="text-base font-normal text-slate-500">/mês</span></div>
                    <ul class="mt-6 space-y-3 text-sm text-slate-500">
                        <li>Até 5 imóveis com relatórios completos</li>
                        <li>Curadoria prime sob demanda</li>
                        <li>Suporte via WhatsApp em horário comercial</li>
                        <li>Dashboard com indicadores básicos</li>
                    </ul>
                    <a href="{{ route('register') }}" class="plan-button">Assinar Start</a>
                </div>
                <div class="plan-card border-2 border-blue-500 shadow-[0_25px_70px_rgba(59,130,246,0.15)]">
                    <div class="inline-flex items-center gap-2 rounded-full bg-blue-500/10 px-4 py-1 text-sm font-semibold text-blue-600">Mais escolhido</div>
                    <h3 class="mt-4 text-xl font-semibold text-slate-900">Prime Growth</h3>
                    <p class="mt-2 text-sm text-slate-500">Perfeito para quem deseja escalar resultados com monitoramento ativo.</p>
                    <div class="mt-6 text-4xl font-semibold text-slate-900">R$ 250<span class="text-base font-normal text-slate-500">/mês</span></div>
                    <ul class="mt-6 space-y-3 text-sm text-slate-500">
                        <li>Até 15 imóveis com destaque premium</li>
                        <li>Consultorias mensais personalizadas</li>
                        <li>Integração com CRM e leads qualificados</li>
                        <li>Analytics avançado e relatórios mensais</li>
                    </ul>
                    <a href="{{ route('register') }}" class="plan-button bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg shadow-blue-500/20 hover:from-indigo-500 hover:to-purple-500">Quero o Growth</a>
                </div>
                <div class="plan-card">
                    <h3 class="text-xl font-semibold text-slate-900">Prime Legacy</h3>
                    <p class="mt-2 text-sm text-slate-500">Para operações robustas que exigem exclusividade e atenção total.</p>
                    <div class="mt-6 text-4xl font-semibold text-slate-900">R$ 200<span class="text-base font-normal text-slate-500">/mês</span></div>
                    <ul class="mt-6 space-y-3 text-sm text-slate-500">
                        <li>Portfólio ilimitado com curadoria contínua</li>
                        <li>Destaques exclusivos e produção de mídia</li>
                        <li>Suporte 24/7 e squad dedicado</li>
                        <li>Monitoramento pós-venda e NPS</li>
                    </ul>
                    <a href="{{ route('register') }}" class="plan-button">Conversar com um especialista</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="bg-slate-50 py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="gold-badge uppercase tracking-[0.3em]">Histórias reais</span>
                <h2 class="mt-6 text-4xl font-semibold text-slate-900">Clientes que elevaram seus resultados</h2>
                <p class="mt-4 text-lg text-slate-600 max-w-3xl mx-auto">Nossa plataforma cria conexões de valor que transformam negócios imobiliários em experiências únicas.</p>
            </div>
            <div class="grid gap-8 md:grid-cols-2">
                <div class="testimonial-card">
                    <p class="text-lg text-slate-600">“Em menos de dois meses, conseguimos fechar três operações relevantes. A curadoria e o acompanhamento foram decisivos para reduzir riscos e acelerar o processo.”</p>
                    <div class="mt-6 flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500"></div>
                        <div>
                            <p class="font-semibold text-slate-900">Fernanda Souza</p>
                            <p class="text-sm text-slate-500">Investidora • São Paulo/SP</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="text-lg text-slate-600">“A equipe Prime Match Imo entende as dores de quem está lançando empreendimentos. Além de leads altamente qualificados, recebemos inteligência de mercado constantemente.”</p>
                    <div class="mt-6 flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500"></div>
                        <div>
                            <p class="font-semibold text-slate-900">Eduardo Martins</p>
                            <p class="text-sm text-slate-500">Diretor Comercial • Curitiba/PR</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="relative overflow-hidden bg-[#050B2C] py-20 text-white">
        <div class="absolute inset-0 opacity-60" style="background: radial-gradient(circle at top right, rgba(59,130,246,0.25), transparent 40%), radial-gradient(circle at bottom left, rgba(124,58,237,0.25), transparent 45%);"></div>
        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="gold-badge uppercase tracking-[0.3em]">Pronto para evoluir?</span>
            <h2 class="mt-6 text-4xl font-semibold">Conduzimos você ao imóvel certo, no momento ideal</h2>
            <p class="mt-4 text-lg text-white/80">Cadastre-se agora e descubra como o matchmaking imobiliário premium impulsiona negócios para investidores, empresários e corretores.</p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-8 py-3 text-lg font-semibold text-[#050B2C] shadow-lg transition hover:bg-blue-50">Criar conta gratuita</a>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-8 py-3 text-lg font-semibold text-white/80 transition hover:border-white hover:text-white">Entrar na minha conta</a>
            </div>
        </div>
    </section>
@endsection
