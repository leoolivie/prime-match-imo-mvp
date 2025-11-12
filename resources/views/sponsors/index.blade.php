@extends('layouts.app')

@section('title', 'Patrocinadores Prime Match Imo')

@section('content')
@php
    use App\Support\ConciergeLink;
@endphp

<div class="py-12">
    <div class="lux-container space-y-12">
        <header class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-4">
                <span class="lux-badge-gold">Marcas parceiras</span>
                <h1 class="font-poppins text-4xl font-semibold text-white">Patrocinadores e marcas que impulsionam experiências prime</h1>
                <p class="max-w-2xl text-white/70">Visibilidade em uma audiência ultraqualificada de investidores e empresários. Patrocínios são ativados pelo concierge único e monitorados com métricas agregadas.</p>
            </div>
            <button type="button" @click="window.dispatchEvent(new CustomEvent('patrocinio-open'))" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Quero patrocinar</button>
        </header>

        <section class="lux-card-dark space-y-8">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-white">Marcas em evidência</h2>
                <span class="lux-badge-outline">Telemetria sem dados sensíveis</span>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                @forelse($partners as $partner)
                    <article class="flex flex-col justify-between rounded-3xl border border-white/10 bg-white/5 p-6 shadow-[0_20px_60px_rgba(0,0,0,0.35)]">
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-white/10 bg-[#0F0F0F] text-sm font-semibold text-white/80">
                                    {{ strtoupper(substr($partner->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-white">{{ $partner->name }}</p>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ strtoupper($partner->category) }}</p>
                                </div>
                            </div>
                            @if($partner->description)
                                <p class="text-sm text-white/60">{{ $partner->description }}</p>
                            @endif
                        </div>
                        <div class="mt-6 flex flex-wrap gap-3">
                            @if($partner->website)
                                <a href="{{ $partner->website }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Visitar site</a>
                            @endif
                            <a href="{{ ConciergeLink::build('investidor_card', ['city' => 'Patrocínio', 'type' => $partner->name], ['user_type' => 'patrocinador', 'source' => 'sponsors_list']) }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com concierge</a>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-3 rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                        Nenhum patrocinador ativo no momento. Seja o primeiro a apoiar a Prime Match Imo com sua marca.
                    </div>
                @endforelse
            </div>
        </section>

        <section class="lux-card-dark">
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-3">
                    <h2 class="text-2xl font-semibold text-white">Benefícios do patrocínio</h2>
                    <ul class="space-y-2 text-sm text-white/60">
                        <li>• Presença em uma audiência premium de investidores e empresários.</li>
                        <li>• Métricas de impressões e cliques disponibilizadas de forma agregada.</li>
                        <li>• Concierge único para ativar ações especiais e experiências exclusivas.</li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <h3 class="text-lg font-semibold text-white">Slots disponíveis</h3>
                    <p class="text-sm text-white/60">Entre em contato e conte seu objetivo. O concierge direciona o formato ideal de exposição e acompanhamento.</p>
                    <button type="button" @click="window.dispatchEvent(new CustomEvent('patrocinio-open'))" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Enviar proposta</button>
                </div>
            </div>
        </section>
    </div>
</div>

<div x-data="patrocinioModal()" x-cloak @patrocinio-open.window="open = true" class="relative">
    <template x-if="open">
        <div class="fixed inset-0 z-[60] flex items-center justify-center bg-black/80 px-4 py-10">
            <div class="w-full max-w-lg space-y-6 rounded-3xl border border-white/10 bg-[#0D0D0D] p-8 shadow-[0_35px_90px_rgba(0,0,0,0.55)]">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-white">Quero patrocinar</h2>
                        <p class="mt-2 text-sm text-white/60">Preencha rapidamente e abra o WhatsApp com o pitch sugerido.</p>
                    </div>
                    <button type="button" class="lux-outline-button px-4 py-2 text-xs uppercase tracking-[0.3em]" @click="reset()">Fechar</button>
                </div>
                <form class="space-y-4" @submit.prevent="submit">
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Marca</label>
                        <input type="text" x-model="form.brand" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Nome da marca" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Site</label>
                        <input type="url" x-model="form.website" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="https://" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Objetivo</label>
                        <textarea x-model="form.goal" rows="3" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Ex.: visibilidade para lançamentos, parceria em eventos..."></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" class="lux-outline-button text-xs uppercase tracking-[0.3em]" @click="reset()">Cancelar</button>
                        <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Abrir WhatsApp</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>

@push('scripts')
<script>
    function patrocinioModal() {
        return {
            open: false,
            form: {
                brand: '',
                website: '',
                goal: '',
            },
            reset() {
                this.open = false;
                this.form = { brand: '', website: '', goal: '' };
            },
            submit() {
                const payload = {
                    brand: this.form.brand,
                    website: this.form.website,
                    goal: this.form.goal,
                };

                const message = `Olá, tenho interesse em patrocinar a Prime Match Imo. Marca: ${payload.brand}. Site: ${payload.website || '—'}. Objetivo: ${payload.goal || 'contato inicial'}.`;
                window.open(`https://wa.me/5514996845854?text=${encodeURIComponent(message)}`, '_blank');
                this.reset();
            },
        };
    }
</script>
@endpush
@endsection
