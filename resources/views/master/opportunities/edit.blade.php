@extends('layouts.app')

@section('title', 'Configurar Oportunidades Prime')

@section('content')
    <div class="py-12">
        <div class="lux-container space-y-10">
            <header class="flex flex-col gap-5 rounded-3xl border border-white/5 bg-[#0E0E0E] p-8 text-white/80">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <span class="lux-badge-gold">Master • Conteúdo dinâmico</span>
                        <h1 class="mt-3 font-poppins text-3xl font-semibold text-white">Editar Oportunidades Prime</h1>
                        <p class="mt-2 max-w-3xl text-sm text-white/60">
                            Altere textos, cards e coleções da landing page de oportunidades. Os dados entram em vigor
                            imediatamente após salvar.
                        </p>
                    </div>
                    <a href="{{ route('landing.opportunities') }}" target="_blank" rel="noopener"
                        class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ver landing</a>
                </div>
                <p class="text-xs text-white/50">
                    Utilize JSON válido nas áreas indicadas. Cada campo aceita variáveis de campanha e links externos.
                </p>
            </header>

            @if (session('success'))
                <div class="rounded-3xl border border-lux-gold/40 bg-lux-gold/10 p-4 text-sm text-lux-gold">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-3xl border border-red-500/30 bg-red-500/5 p-4 text-sm text-red-300">
                    <p class="font-semibold">Verifique os campos:</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $jsonFlags = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
            @endphp

            <form action="{{ route('master.opportunities.update') }}" method="POST" class="space-y-10">
                @csrf
                @method('PUT')

                <section class="lux-card-dark space-y-6">
                    <h2 class="text-2xl font-semibold text-white">Hero principal</h2>
                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="flex flex-col gap-2 text-sm text-white/70">
                            <span>Badge</span>
                            <input type="text" name="hero_badge" class="lux-input"
                                value="{{ old('hero_badge', $content['hero']['badge']) }}" required>
                        </label>
                        <label class="flex flex-col gap-2 text-sm text-white/70">
                            <span>Título</span>
                            <input type="text" name="hero_title" class="lux-input"
                                value="{{ old('hero_title', $content['hero']['title']) }}" required>
                        </label>
                    </div>
                    <label class="flex flex-col gap-2 text-sm text-white/70">
                        <span>Descrição</span>
                        <textarea name="hero_description" class="lux-textarea" rows="3" required>{{ old('hero_description', $content['hero']['description']) }}</textarea>
                    </label>
                    <label class="flex flex-col gap-2 text-sm text-white/70">
                        <span>Texto de apoio</span>
                        <textarea name="hero_support_text" class="lux-textarea" rows="3" required>{{ old('hero_support_text', $content['hero']['support_text']) }}</textarea>
                    </label>
                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="flex flex-col gap-2 text-sm text-white/70">
                            <span>CTA Empresário</span>
                            <input type="text" name="hero_businessman_cta_label" class="lux-input"
                                value="{{ old('hero_businessman_cta_label', $content['hero']['businessman_cta_label']) }}" required>
                        </label>
                        <label class="flex flex-col gap-2 text-sm text-white/70">
                            <span>CTA Investidor</span>
                            <input type="text" name="hero_investor_cta_label" class="lux-input"
                                value="{{ old('hero_investor_cta_label', $content['hero']['investor_cta_label']) }}" required>
                        </label>
                    </div>
                </section>

                <section class="lux-card-dark space-y-6">
                    <h2 class="text-2xl font-semibold text-white">Card lateral & métricas</h2>
                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="flex flex-col gap-2 text-sm text-white/70">
                            <span>Badge do card</span>
                            <input type="text" name="cta_card_badge" class="lux-input"
                                value="{{ old('cta_card_badge', $content['cta_card']['badge']) }}" required>
                        </label>
                        <label class="flex flex-col gap-2 text-sm text-white/70">
                            <span>Título do card</span>
                            <input type="text" name="cta_card_title" class="lux-input"
                                value="{{ old('cta_card_title', $content['cta_card']['title']) }}" required>
                        </label>
                    </div>
                    <label class="flex flex-col gap-2 text-sm text-white/70">
                        <span>Descrição do card</span>
                        <textarea name="cta_card_description" class="lux-textarea" rows="3" required>{{ old('cta_card_description', $content['cta_card']['description']) }}</textarea>
                    </label>
                    <label class="flex flex-col gap-2 text-sm text-white/70">
                        <span>Passos (JSON)</span>
                        <textarea name="cta_card_steps" class="lux-textarea" rows="4" required>{{ old('cta_card_steps', json_encode($content['cta_card']['steps'], $jsonFlags)) }}</textarea>
                        <span class="text-xs text-white/40">Estrutura esperada: [{"label": "Texto"}]</span>
                    </label>
                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="flex flex-col gap-2 text-sm text-white/70">
                            <span>Título VIP</span>
                            <input type="text" name="cta_card_vip_title" class="lux-input"
                                value="{{ old('cta_card_vip_title', $content['cta_card']['vip_title']) }}" required>
                        </label>
                        <label class="flex flex-col gap-2 text-sm text-white/70">
                            <span>Descrição VIP</span>
                            <textarea name="cta_card_vip_description" class="lux-textarea" rows="3" required>{{ old('cta_card_vip_description', $content['cta_card']['vip_description']) }}</textarea>
                        </label>
                    </div>
                    <label class="flex flex-col gap-2 text-sm text-white/70">
                        <span>Métricas do hero (JSON)</span>
                        <textarea name="hero_metrics" class="lux-textarea" rows="6" required>{{ old('hero_metrics', json_encode($content['hero_metrics'], $jsonFlags)) }}</textarea>
                        <span class="text-xs text-white/40">Campos: label, value, description.</span>
                    </label>
                </section>

                <section class="lux-card-dark space-y-6">
                    <h2 class="text-2xl font-semibold text-white">Listas dinâmicas</h2>
                    <label class="flex flex-col gap-2 text-sm text-white/70">
                        <span>Mentores (JSON)</span>
                        <textarea name="mentors" class="lux-textarea" rows="8" required>{{ old('mentors', json_encode($content['mentors'], $jsonFlags)) }}</textarea>
                        <span class="text-xs text-white/40">Campos: name, role, description, youtube_url, avatar_url.</span>
                    </label>
                    <label class="flex flex-col gap-2 text-sm text-white/70">
                        <span>Parceiros (JSON)</span>
                        <textarea name="partners" class="lux-textarea" rows="8" required>{{ old('partners', json_encode($content['partners'], $jsonFlags)) }}</textarea>
                        <span class="text-xs text-white/40">Campos: name, category, description, logo.</span>
                    </label>
                    <label class="flex flex-col gap-2 text-sm text-white/70">
                        <span>Oportunidades (JSON)</span>
                        <textarea name="opportunities" class="lux-textarea" rows="12" required>{{ old('opportunities', json_encode($content['opportunities'], $jsonFlags)) }}</textarea>
                        <span class="text-xs text-white/40">Inclua slug, títulos, faixas, tags e destaque premium.</span>
                    </label>
                    <label class="flex flex-col gap-2 text-sm text-white/70">
                        <span>Insights (JSON)</span>
                        <textarea name="insights" class="lux-textarea" rows="6" required>{{ old('insights', json_encode($content['insights'], $jsonFlags)) }}</textarea>
                        <span class="text-xs text-white/40">Campos: title, summary, url.</span>
                    </label>
                </section>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('master.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Cancelar</a>
                    <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.35em]">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
@endsection
