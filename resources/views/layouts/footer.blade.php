@php
    $conciergeLink = 'https://wa.me/5514996845854?text=' . rawurlencode('Olá concierge Prime Match Imo, quero conversar com a equipe.');
@endphp

<footer class="relative border-t border-white/10 bg-[#05040d] text-lux-ice">
    <div class="absolute inset-0 opacity-70" style="background: radial-gradient(circle at top right, rgba(255,215,0,0.18), transparent 55%), radial-gradient(circle at bottom left, rgba(59,130,246,0.2), transparent 55%);"></div>
    <div class="relative lux-container py-16">
        <div class="grid gap-12 lg:grid-cols-4">
            <div class="space-y-5">
                <div class="flex items-center gap-4">
                    <span class="flex h-12 w-12 items-center justify-center rounded-3xl border border-lux-gold/40 bg-white/5 text-lg font-semibold tracking-[0.3em] text-lux-gold shadow-[0_0_35px_rgba(255,215,0,0.35)]">PM</span>
                    <div>
                        <p class="text-lg font-semibold text-white">Prime Match Imo</p>
                        <p class="text-[11px] uppercase tracking-[0.35em] text-white/60">Matchmaking imobiliário prime</p>
                    </div>
                </div>
                <p class="text-sm leading-relaxed text-white/70">
                    Inteligência de dados, concierge 24/7 e uma rede exclusiva para conectar oportunidades imobiliárias de alto padrão a investidores, empresários e consultores prime.
                </p>
                <a href="{{ $conciergeLink }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.25em]">
                    Falar com concierge
                </a>
            </div>
            <div>
                <span class="lux-badge-outline">Plataforma</span>
                <ul class="mt-6 space-y-3 text-sm text-white/70">
                    <li>Curadoria com IA + concierge</li>
                    <li>Gestão completa de portfólios</li>
                    <li>Indicadores financeiros ao vivo</li>
                    <li>Dossiês e diligência acelerada</li>
                </ul>
            </div>
            <div>
                <span class="lux-badge-outline">Experiências</span>
                <ul class="mt-6 space-y-3 text-sm text-white/70">
                    <li>Matchs cinematográficos</li>
                    <li>Visitas guiadas e virtuais</li>
                    <li>Suporte jurídico e fiscal</li>
                    <li>Concierge omnichannel</li>
                </ul>
            </div>
            <div>
                <span class="lux-badge-outline">Contato</span>
                <ul class="mt-6 space-y-3 text-sm text-white/70">
                    <li>concierge@primematchimo.com.br</li>
                    <li>+55 (14) 99684-5854</li>
                    <li>São Paulo • Ribeirão Preto • Florianópolis</li>
                    <li>Atendimento premium 24/7</li>
                </ul>
            </div>
        </div>
        <div class="mt-14 flex flex-col gap-4 border-t border-white/10 pt-8 text-sm text-white/50 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} Prime Match Imo. Todos os direitos reservados.</p>
            <div class="flex flex-wrap gap-4 text-xs uppercase tracking-[0.3em] text-white/40">
                <span>LGPD Ready</span>
                <span>Concierge Prime</span>
                <span>IA Assistida</span>
            </div>
        </div>
    </div>
</footer>
