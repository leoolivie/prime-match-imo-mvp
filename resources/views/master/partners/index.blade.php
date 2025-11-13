@extends('layouts.app')

@section('title', 'Master • Parceiros Prime')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-12">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="lux-badge-gold">Master • Curadoria</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Ecossistema de parceiros prime</h1>
                <p class="text-sm text-white/60">Monitore status, categoria e contatos estratégicos. Ative concierge administrativo para missões especiais.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('master.partners.create') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">+ Parceiro</a>
                <a href="{{ route('master.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Dashboard</a>
            </div>
        </div>

        <div class="lux-grid-cards">
            @forelse($partners as $partner)
                <article class="lux-card-dark space-y-4">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">{{ ucfirst($partner->category) }}</p>
                            <h2 class="mt-2 text-xl font-semibold text-white">{{ $partner->name }}</h2>
                        </div>
                        <span class="lux-badge-outline">{{ $partner->active ? 'Ativo' : 'Em pausa' }}</span>
                    </div>
                    @if($partner->description)
                        <p class="text-sm text-white/60">{{ \Illuminate\Support\Str::limit($partner->description, 160) }}</p>
                    @endif

                    <div class="grid gap-3 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-3">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Site</p>
                            @if($partner->website)
                                <a href="{{ $partner->website }}" target="_blank" rel="noopener" class="text-sm text-lux-gold hover:underline break-all">{{ $partner->website }}</a>
                            @else
                                <p class="text-sm text-white/40">Não informado</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">E-mail</p>
                            @if($partner->contact_email)
                                <a href="mailto:{{ $partner->contact_email }}" class="text-sm text-lux-gold hover:underline">{{ $partner->contact_email }}</a>
                            @else
                                <p class="text-sm text-white/40">Não informado</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/50">Telefone</p>
                            @if($partner->contact_phone)
                                <p class="text-sm text-white/70">{{ $partner->contact_phone }}</p>
                            @else
                                <p class="text-sm text-white/40">Não informado</p>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/60">
                    Nenhum parceiro cadastrado. Utilize o botão "+ Parceiro" para iniciar a curadoria estratégica.
                </div>
            @endforelse
        </div>

        <div>
            {{ $partners->links() }}
        </div>
    </div>
</div>
@endsection
