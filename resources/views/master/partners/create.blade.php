@extends('layouts.app')

@section('title', 'Master • Novo Parceiro')

@section('content')
<div class="py-12">
    <div class="lux-container max-w-4xl space-y-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="lux-badge-gold">Adicionar parceiro</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Curadoria administrativa</h1>
                <p class="text-sm text-white/60">Registre players estratégicos de jurídico, finanças, arquitetura e mais para suportar operações concierge.</p>
            </div>
            <a href="{{ route('master.partners') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Voltar</a>
        </div>

        <div class="lux-card-dark">
            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-red-400/30 bg-red-500/15 px-4 py-3 text-sm text-red-200">
                    <ul class="list-disc space-y-1 pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('master.partners.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Nome do parceiro</label>
                        <input name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Nome fantasia" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Descrição</label>
                        <textarea name="description" rows="4" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Posicionamento, entregáveis, diferenciais">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Categoria</label>
                        <select name="category" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                            <option value="legal" @selected(old('category') === 'legal')>Jurídico</option>
                            <option value="financial" @selected(old('category') === 'financial')>Financeiro</option>
                            <option value="construction" @selected(old('category') === 'construction')>Construção</option>
                            <option value="architecture" @selected(old('category') === 'architecture')>Arquitetura</option>
                            <option value="other" @selected(old('category') === 'other')>Outro</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Website</label>
                        <input type="url" name="website" value="{{ old('website') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="https://" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">E-mail de contato</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="contato@parceiro.com" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Telefone</label>
                        <input name="contact_phone" value="{{ old('contact_phone') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="(00) 00000-0000" />
                    </div>
                    <div class="md:col-span-2">
                        <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                            <input type="checkbox" name="active" value="1" id="active" class="h-4 w-4 rounded border-white/20 bg-transparent text-lux-gold focus:ring-lux-gold" @checked(old('active', true)) />
                            <label for="active" class="text-sm text-white/70">Parceiro ativo (visível para concierge e dashboards)</label>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('master.partners') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Cancelar</a>
                    <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Salvar parceiro</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
