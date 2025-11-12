<section id="investidor" class="lux-section">
    <div class="lux-container">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
            <div class="max-w-xl space-y-6">
                <span class="lux-badge-outline">Para investidores</span>
                <h2 class="font-poppins text-4xl font-semibold text-white">Landing cinematográfica com filtros inteligentes</h2>
                <p class="text-white/60">
                    Acesse imóveis com indicadores financeiros atualizados, status de diligência e ações rápidas para visita,
                    dossiê ou concierge – tudo sem sair do dashboard.
                </p>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="lux-card-surface">
                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Filtros prime</p>
                        <p class="mt-2 text-sm text-white/70">Cidade, tipologia, faixa de valor e preferências financeiras com salvamento automático.</p>
                    </div>
                    <div class="lux-card-surface">
                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Cards cinematográficos</p>
                        <p class="mt-2 text-sm text-white/70">Descrição curada, snapshots financeiros e status de diligência com CTAs omnichannel.</p>
                    </div>
                </div>
            </div>
            <div class="lux-card-dark w-full max-w-2xl">
                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-white/10 pb-6">
                    <h3 class="text-xl font-semibold text-white">Como funciona</h3>
                    <div class="flex gap-2">
                        <span class="lux-tab lux-tab-active">Recomendações</span>
                        <span class="lux-tab">Negociações</span>
                        <span class="lux-tab">Watchlist</span>
                    </div>
                </div>
                <div class="mt-6 grid gap-4">
                    <div class="lux-property-card">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Campos do Jordão • High-end</p>
                                <h4 class="mt-1 text-lg font-semibold text-white">Chalé boutique com concierge full service</h4>
                            </div>
                            <span class="lux-property-status text-white/70">Diligência 92%</span>
                        </div>
                        <p class="text-sm text-white/60">Renda híbrida com estadias premium e programa de hospitalidade exclusivo com concierge Prime Match.</p>
                        <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-3">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</p>
                                <p class="mt-1 text-lg font-semibold text-white">R$ 6.480.000</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Yield esperado</p>
                                <p class="mt-1 text-lg font-semibold text-white">14,5% a.a.</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Concierge</p>
                                <p class="mt-1 text-lg font-semibold text-white">Pronto em 5 min</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('register') }}" class="lux-gold-button text-xs uppercase tracking-[0.25em]">Marcar visita</a>
                            <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, quero falar sobre o chalé boutique de Campos do Jordão.') }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Concierge agora</a>
                            <a href="{{ route('login') }}" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Salvar na watchlist</a>
                        </div>
                    </div>
                    <div class="lux-property-card">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Florianópolis • Corporate</p>
                                <h4 class="mt-1 text-lg font-semibold text-white">Campus tech com contrato triple net</h4>
                            </div>
                            <span class="lux-property-status text-white/70">Negociação ativa</span>
                        </div>
                        <p class="text-sm text-white/60">Contrato de 12 anos com reajuste IPCA, expansão planejada e concierge dedicado para visitas e due diligence.</p>
                        <div class="grid gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-3">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</p>
                                <p class="mt-1 text-lg font-semibold text-white">R$ 42.000.000</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Cap rate</p>
                                <p class="mt-1 text-lg font-semibold text-white">9,2%</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-white/50">Concierge</p>
                                <p class="mt-1 text-lg font-semibold text-white">War room pronto</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('register') }}" class="lux-gold-button text-xs uppercase tracking-[0.25em]">Agendar dossiê</a>
                            <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, quero avançar com o campus tech em Florianópolis.') }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Concierge</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
