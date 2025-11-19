@extends('layouts.app')

@section('title', 'Painel do Empresário Prime')

@section('content')
@php
    use App\Support\ConciergeLink;
    use App\Support\Format;
    use Illuminate\Support\Facades\Storage;

    $canManageProperties = $user->hasApprovedPropertyAccess();
@endphp

<div class="py-12">
    <div class="lux-container space-y-16">
        <header class="lux-card-dark">
            <div class="flex flex-col gap-10 lg:flex-row lg:flex-wrap lg:items-start lg:justify-between">
                <div class="space-y-5 lg:flex-1">
                    <span class="lux-badge-gold">Empresário prime</span>
                    <div class="space-y-4">
                        <h1 class="font-poppins text-4xl font-semibold text-white">Gerencie seu portfólio com suporte concierge</h1>
                        <p class="max-w-2xl text-white/70">Cadastre imóveis, monitore visitas e cliques no WhatsApp e peça ajuda ao concierge único sempre que precisar destacar um ativo.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @if($canManageProperties)
                            <a href="{{ route('businessman.property.create') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Cadastrar imóvel</a>
                        @else
                            <span class="lux-outline-button text-xs uppercase tracking-[0.3em] text-white/60">Aguardando liberação master</span>
                        @endif
                        <a href="{{ route('businessman.properties') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Minha vitrine</a>
                        <a href="{{ ConciergeLink::forBusinessmanSupport() }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Falar com concierge</a>
                    </div>
                    @if(!$canManageProperties)
                        <div class="rounded-2xl border border-amber-400/30 bg-amber-500/10 p-5 text-sm text-amber-100">
                            <p class="font-semibold text-amber-50">Estamos validando seu CRECI.</p>
                            <p class="mt-2 text-amber-100/80">
                                Assim que o Master confirmar o registro <strong>{{ $user->creci ?? 'não informado' }}</strong> (CPF/CNPJ <strong>{{ $user->cpf_cnpj ?? 'não informado' }}</strong>, UF <strong>{{ $user->businessman_state ?? '--' }}</strong>) você poderá cadastrar imóveis.
                                Nosso time já foi notificado — acompanhe seu e-mail para a liberação.
                            </p>
                        </div>
                    @endif
                </div>
                <div class="grid w-full flex-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Portfólio</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['total_properties']) }}</span>
                        <span class="text-white/40">Imóveis cadastrados</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Ativos</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['active_properties']) }}</span>
                        <span class="text-white/40">Disponíveis agora</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Visitas (30d)</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['visits_30']) }}</span>
                        <span class="text-white/40">Telemetria agregada</span>
                    </div>
                    <div class="lux-stat-bubble">
                        <span class="text-white/60">Conversão</span>
                        <span class="text-2xl font-semibold text-white">{{ number_format($stats['conversion'], 1) }}%</span>
                        <span class="text-white/40">WhatsApp / visitas</span>
                    </div>
                </div>
            </div>
        </header>

        <section class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="lux-card-dark space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-white">Imóvel destaque Prime</h2>
                    <a href="{{ route('businessman.plans') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Destaque Prime</a>
                </div>
                @if($subscription)
                    <div class="grid gap-4 rounded-2xl border border-lux-gold/40 bg-lux-gold/10 p-6 text-white shadow-lux-glow sm:grid-cols-2">
                        <div class="space-y-2">
                            <p class="text-xs uppercase tracking-[0.3em] text-white/70">Plano ativo</p>
                            <h3 class="text-2xl font-semibold text-white">{{ $subscription->plan->name }}</h3>
                            <p class="text-sm text-white/70">Válido até {{ $subscription->end_date->format('d/m/Y') }}</p>
                        </div>
                        <div class="space-y-2 text-sm text-white/80">
                            <p>Investimento: <span class="font-semibold">R$ {{ number_format($subscription->plan->price, 2, ',', '.') }}</span></p>
                            <p>
                                @if($subscription->plan->isUnlimited())
                                    Imóveis ilimitados
                                @else
                                    {{ $subscription->remaining_properties }} de {{ $subscription->plan->property_limit }} anúncios disponíveis
                                @endif
                            </p>
                        </div>
                    </div>
                @else
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 text-white/70 space-y-4">
                        <div class="rounded-2xl border border-lux-gold/40 bg-gradient-to-br from-[#161616] to-[#0a0a0a] p-4 text-sm text-white/70 shadow-[0_15px_45px_rgba(203,161,53,0.25)]">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Imóvel Prêmio</p>
                            <h3 class="text-lg font-semibold text-white">Destaque Prime</h3>
                            <p class="mt-2 text-sm text-white/70">Acenda o brilho dourado no seu anúncio: o investimento em destaque ativa campanhas de visibilidade, aumenta cliques e coloca o seu imóvel em prioridade para investidores com matching pronto.</p>
                            <ul class="mt-3 space-y-2 text-xs text-white/60">
                                <li>• Mais visibilidade na vitrine Prime e push direto para o concierge.</li>
                                <li>• Campanhas pagas alimentadas pelos recursos do Master.</li>
                                <li>• Antena concierge acionada com alertas VIP para investidores selecionados.</li>
                            </ul>
                            <p class="mt-3 text-[11px] text-white/50">Combine o plano com o concierge para montar a campanha, scripts e agenda perfeita.</p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ ConciergeLink::forBusinessmanSupport() }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com concierge</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="space-y-6">
                <div class="lux-card-dark">
                    <h3 class="text-lg font-semibold text-white">Atalhos concierge</h3>
                    <p class="mt-2 text-sm text-white/60">Todo contato abre o WhatsApp com mensagem pronta para acelerar suas campanhas.</p>
                    <div class="mt-4 grid gap-3">
                        <a href="{{ ConciergeLink::forBusinessmanSupport() }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Acionar concierge</a>
                        <a href="mailto:concierge@primematchimo.com.br" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Enviar briefing</a>
                    </div>
                </div>
                <div class="lux-card-dark">
                    <h3 class="text-lg font-semibold text-white">Dicas rápidas</h3>
                    <ul class="mt-4 space-y-3 text-sm text-white/60">
                        <li>• Atualize descrições com resultados financeiros para elevar o interesse.</li>
                        <li>• Publique com riqueza de detalhes: imóveis consistentes podem ser convidados para a vitrine prime pelo Master.</li>
                        <li>• Registre vídeos curtos; o concierge envia ao investidor com contexto.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="space-y-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-white">Minha vitrine</h2>
                <div class="flex flex-wrap gap-2">
                    @if($canManageProperties)
                        <a href="{{ route('businessman.property.create') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">+ Imóvel</a>
                    @else
                        <span class="lux-outline-button text-xs uppercase tracking-[0.3em] text-white/60">Liberação pendente</span>
                    @endif
                    <a href="{{ ConciergeLink::forBusinessmanSupport() }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Preciso de ajuda</a>
                </div>
            </div>
            <div class="lux-grid-cards">
                @forelse($properties as $property)
                    @php
                        $imagePath = optional($property->primaryImage)->path;
                        $image = $imagePath ? Storage::disk('public')->url($imagePath) : asset('images/placeholders/luxury-property.svg');
                        $metrics = $property->dashboard_metrics ?? ['views7' => 0, 'views30' => 0, 'clicks30' => 0, 'conversion' => 0];
                    @endphp
                    <article class="lux-property-card">
                        <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#0B0B0B]">
                            <img src="{{ $image }}" alt="{{ $property->title }}" class="h-44 w-full object-cover" loading="lazy" />
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ $property->city }} • {{ $property->state }}</p>
                                    <h3 class="mt-2 text-xl font-semibold text-white">{{ $property->title }}</h3>
                                </div>
                                <span class="lux-property-status text-white/70">{{ $property->status_label }}</span>
                            </div>
                            <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-[1.6fr_1fr_1fr]">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</p>
                                    <p class="mt-1 text-lg font-semibold text-white">{{ Format::currency($property->price) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Visitas (7d)</p>
                                    <p class="mt-1 text-lg font-semibold text-white">{{ $metrics['views7'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">Cliques (30d)</p>
                                    <p class="mt-1 text-lg font-semibold text-white">{{ $metrics['clicks30'] }}</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('businessman.property.edit', $property) }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Editar</a>
                                <form method="POST" action="{{ route('businessman.property.destroy', $property) }}" onsubmit="return confirm('Deseja remover este imóvel?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Desativar</button>
                                </form>
                                <a href="{{ ConciergeLink::forBusinessmanSupport($property) }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Concierge</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                        Nenhum imóvel cadastrado. Publique seu primeiro ativo e acompanhe visitas e cliques em tempo real.
                    </div>
                @endforelse
            </div>
            <div>
                {{ $properties->links() }}
            </div>
        </section>
    </div>
</div>
@endsection
