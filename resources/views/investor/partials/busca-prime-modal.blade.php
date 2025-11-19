<div x-data="buscaPrime()" x-cloak @busca-prime-open.window="open = true" class="relative">
    <template x-if="open">
        <div class="fixed inset-0 z-[60] flex items-center justify-center bg-black/80 px-4 py-10">
            <div class="w-full max-w-2xl space-y-6 rounded-3xl border border-white/10 bg-[#0D0D0D] p-8 shadow-[0_35px_90px_rgba(0,0,0,0.55)]">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-white">Busca Prime Concierge</h2>
                        <p class="mt-2 text-sm text-white/60">Informe cidade, tipologia, budget e preferências. Verificamos instantaneamente a base prime e mostramos os matches no modal.</p>
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
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">Tipologia</label>
                            <select x-model="form.type" class="mt-2 lux-select">
                                <option value="">Qualquer</option>
                                <option value="apartment">Apartamento</option>
                                <option value="house">Casa</option>
                                <option value="commercial">Comercial</option>
                                <option value="land">Terreno</option>
                                <option value="other">Outro formato</option>
                            </select>
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
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Detalhes adicionais</label>
                        <textarea x-model="form.details" rows="3" placeholder="Vista panorâmica, rooftop, heliponto, marquise corporativa..." class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none"></textarea>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Urgência</label>
                        <select x-model="form.urgency" class="mt-2 lux-select">
                            <option value="">Selecione</option>
                            <option value="Imediata">Imediata</option>
                            <option value="Próximos 30 dias">Próximos 30 dias</option>
                            <option value="Planejamento">Planejamento</option>
                        </select>
                    </div>
                    <div class="flex flex-wrap justify-end gap-3 pt-4">
                        <button type="button" class="lux-outline-button text-xs uppercase tracking-[0.3em]" @click="reset()">Cancelar</button>
                        <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]" :disabled="loading">
                            <span x-show="!loading">Buscar prime</span>
                            <span x-show="loading">Buscando...</span>
                        </button>
                    </div>
                </form>
                <div x-cloak>
                    <template x-if="error">
                        <div class="rounded-2xl border border-red-400/30 bg-red-500/15 px-4 py-3 text-sm font-medium text-red-200" x-text="error"></div>
                    </template>
                    <template x-if="submitted">
                        <div class="space-y-4">
                            <template x-if="results.length">
                                <div class="space-y-4">
                                    <template x-for="result in results" :key="result.id">
                                        <article class="flex flex-col gap-4 rounded-3xl border border-white/10 bg-white/5 p-5 sm:flex-row">
                                            <div class="sm:w-48">
                                                <img :src="result.image_url" :alt="result.title" class="h-48 w-full rounded-2xl object-cover" loading="lazy">
                                            </div>
                                            <div class="flex flex-1 flex-col gap-3">
                                                <div>
                                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50" x-text="result.city + ' • ' + result.state"></p>
                                                    <h3 class="text-xl font-semibold text-white" x-text="result.title"></h3>
                                                </div>
                                                <p class="text-sm text-white/70" x-text="result.price_formatted"></p>
                                                <div class="flex flex-wrap gap-2 text-xs uppercase tracking-[0.3em] text-white/50">
                                                    <template x-if="result.area_formatted">
                                                        <span class="rounded-full border border-white/10 px-3 py-1 text-white/80" x-text="result.area_formatted"></span>
                                                    </template>
                                                    <template x-if="result.bedrooms">
                                                        <span class="rounded-full border border-white/10 px-3 py-1 text-white/80" x-text="result.bedrooms + ' quartos'"></span>
                                                    </template>
                                                    <template x-if="result.bathrooms">
                                                        <span class="rounded-full border border-white/10 px-3 py-1 text-white/80" x-text="result.bathrooms + ' banhos'"></span>
                                                    </template>
                                                </div>
                                                <div class="flex flex-wrap gap-3">
                                                    <a :href="result.detail_url" class="lux-outline-button text-xs uppercase tracking-[0.3em]" target="_blank" rel="noopener">Ver detalhes</a>
                                                    <a :href="result.concierge_url" class="lux-gold-button text-xs uppercase tracking-[0.3em]" target="_blank" rel="noopener">Falar com concierge</a>
                                                </div>
                                            </div>
                                        </article>
                                    </template>
                                    <div class="flex flex-wrap justify-end gap-3">
                                        <button type="button" class="lux-gold-button text-xs uppercase tracking-[0.3em]" @click="openConcierge()">Acionar concierge com esse briefing</button>
                                    </div>
                                </div>
                            </template>
                            <template x-if="results.length === 0">
                                <div class="rounded-3xl border border-white/10 bg-white/5 p-6 text-sm text-white/70">
                                    <p>Não encontramos imóveis disponíveis que atendam exatamente a este briefing agora. Nosso concierge está ativando uma busca prioritária no WhatsApp.</p>
                                    <p class="mt-2 text-xs uppercase tracking-[0.3em] text-white/40">Você será direcionado para o atendimento personalizado.</p>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </template>
</div>

@once
@push('scripts')
<script>
    function buscaPrime() {
        return {
            open: false,
            loading: false,
            submitted: false,
            error: null,
            results: [],
            tags: ['Vista panorâmica', 'Pé na areia', 'Heliponto', 'Triple A', 'Residencial clube', 'Turn key'],
            form: {
                city: '',
                type: '',
                budget_min: '',
                budget_max: '',
                tags: [],
                details: '',
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
                this.loading = false;
                this.error = null;
                this.submitted = false;
                this.results = [];
                this.form = {
                    city: '',
                    type: '',
                    budget_min: '',
                    budget_max: '',
                    tags: [],
                    details: '',
                    urgency: '',
                };
            },
            composeBriefingText() {
                const parts = [
                    this.form.city ? `Cidade: ${this.form.city}` : null,
                    this.form.type ? `Tipologia: ${this.form.type}` : null,
                    this.form.budget_min ? `Budget mín.: R$ ${this.form.budget_min}` : null,
                    this.form.budget_max ? `Budget máx.: R$ ${this.form.budget_max}` : null,
                    this.form.tags.length ? `Preferências: ${this.form.tags.join(', ')}` : null,
                    this.form.details ? `Detalhes: ${this.form.details}` : null,
                    this.form.urgency ? `Urgência: ${this.form.urgency}` : null,
                ].filter(Boolean);

                return parts.join(' • ') || 'Sem filtros específicos';
            },
            async submit() {
                this.loading = true;
                this.error = null;
                this.submitted = false;
                this.results = [];

                const payload = {
                    city: this.form.city,
                    type: this.form.type,
                    budget_min: this.form.budget_min,
                    budget_max: this.form.budget_max,
                    tags: this.form.tags,
                    details: this.form.details,
                    urgency: this.form.urgency,
                };

                try {
                    const response = await fetch('{{ route('investor.prime-search') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            Accept: 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify(payload),
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        this.error = data?.message ?? 'Não foi possível buscar imóveis agora. Tente novamente em instantes.';
                        return;
                    }

                    this.results = Array.isArray(data.matches) ? data.matches : [];
                    this.submitted = true;

                    if (this.results.length === 0) {
                        this.openWhatsappFallback();
                    }
                } catch (error) {
                    this.error = 'Não foi possível buscar imóveis agora. Tente novamente em instantes.';
                } finally {
                    this.loading = false;
                }
            },
            openWhatsappFallback() {
                const message = `Olá Prime Concierge, preciso ativar uma Busca Prime com o briefing: ${this.composeBriefingText()}. Pode me ajudar?`;
                const url = 'https://wa.me/5514996845854?text=' + encodeURIComponent(message);
                window.location.href = url;
            },
            openConcierge() {
                const payload = {
                    city: this.form.city,
                    type: this.form.type,
                    budget_min: this.form.budget_min,
                    budget_max: this.form.budget_max,
                    tags: this.form.tags,
                    details: this.form.details,
                    urgency: this.form.urgency,
                };

                const url = new URL('{{ route('concierge.redirect') }}');
                url.searchParams.set('context', 'busca_prime');
                url.searchParams.set('user_type', 'investidor');
                url.searchParams.set('source', 'busca_prime_modal');
                url.searchParams.set('payload', btoa(unescape(encodeURIComponent(JSON.stringify(payload)))));

                window.open(url.toString(), '_blank');
            },
        };
    }
</script>
@endpush
@endonce
