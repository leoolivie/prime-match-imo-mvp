@extends('layouts.app')

@section('title', 'Master - Prime Match Imo')

@section('content')
    <section class="lux-hero">
        <div class="lux-container py-20">
            <div class="grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                <div class="space-y-8">
                    <span class="lux-badge-gold">Comando total para masters</span>
                    <h1 class="font-poppins text-4xl font-semibold leading-tight text-white sm:text-5xl">
                        Controle completo de usuários, imóveis, planos e concierge com orquestração premium
                    </h1>
                    <p class="max-w-2xl text-base text-white/70 sm:text-lg">
                        Administre a operação prime com governança, métricas em tempo real e atalhos "ver como" para assumir qualquer persona instantaneamente, mantendo branding e compliance impecáveis.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ auth()->check() ? route('master.dashboard') : route('login') }}" class="lux-gold-button text-sm uppercase tracking-[0.25em]">
                            Entrar no dashboard master
                        </a>
                        <a href="{{ route('register') }}" class="lux-outline-button text-sm uppercase tracking-[0.25em]">
                            Solicitar credencial
                        </a>
                        <a href="https://wa.me/5514996845854?text={{ rawurlencode('Olá concierge Prime Match Imo, preciso de suporte administrativo master.') }}" target="_blank" rel="noopener" class="lux-outline-button text-sm uppercase tracking-[0.25em]">
                            Concierge administrativo
                        </a>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Governança</p>
                            <p class="mt-2 text-2xl font-semibold text-white">Auditoria 100%</p>
                            <p class="mt-1 text-sm text-white/60">Trilhas completas de aprovação e logs customizados por equipe.</p>
                        </div>
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Permissões</p>
                            <p class="mt-2 text-2xl font-semibold text-white">Controle granular</p>
                            <p class="mt-1 text-sm text-white/60">Defina acessos por papel, status e planos em segundos.</p>
                        </div>
                        <div class="lux-card-surface">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/50">Insights</p>
                            <p class="mt-2 text-2xl font-semibold text-white">KPIs em tempo real</p>
                            <p class="mt-1 text-sm text-white/60">Painéis cinemáticos com métricas cruzadas e alertas.</p>
                        </div>
                    </div>
                </div>
                <div class="lux-card-dark space-y-6">
                    <div class="flex items-center justify-between border-b border-white/10 pb-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Central master</p>
                            <h3 class="mt-2 text-2xl font-semibold text-white">Orquestração de operações</h3>
                        </div>
                        <span class="lux-badge-outline">Modo stealth</span>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="lux-card-gold">
                            <h4 class="text-lg font-semibold text-white">Controle de branding</h4>
                            <p class="mt-2 text-sm text-white/70">Personalize voz, identidade visual e materiais enviados em cada pipeline.</p>
                        </div>
                        <div class="lux-card-gold">
                            <h4 class="text-lg font-semibold text-white">Operações concierge</h4>
                            <p class="mt-2 text-sm text-white/70">Distribua leads por concierge, monitore SLAs e acione suporte imediato.</p>
                        </div>
                        <div class="lux-card-gold">
                            <h4 class="text-lg font-semibold text-white">Gestão de planos</h4>
                            <p class="mt-2 text-sm text-white/70">Ative, atualize ou paute planos com glow dourado e notificações automáticas.</p>
                        </div>
                        <div class="lux-card-gold">
                            <h4 class="text-lg font-semibold text-white">Relatórios instantâneos</h4>
                            <p class="mt-2 text-sm text-white/70">Exportações prime com insights de IA e auditoria pronta para conselho.</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('master.users') }}" class="lux-gold-button text-xs uppercase tracking-[0.25em]">Gerenciar usuários</a>
                        <a href="{{ route('master.properties') }}" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Supervisionar imóveis</a>
                        <a href="{{ route('master.partners') }}" class="lux-outline-button text-xs uppercase tracking-[0.25em]">Curadoria de parceiros</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('landing.partials.master')
@endsection
