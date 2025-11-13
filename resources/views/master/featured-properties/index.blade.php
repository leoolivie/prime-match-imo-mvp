@extends('layouts.app')

@section('title', 'Master • Imóveis em Destaque')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-12">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="lux-badge-gold">Master • Imóveis em Destaque</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Vitrine prime curada pelo Master</h1>
                <p class="text-sm text-white/60">Gerencie os ativos que ocupam a seção mais nobre da plataforma. Apenas 16 imóveis podem ser exibidos simultaneamente.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('master.featured-properties.create') }}" class="lux-gold-button text-xs uppercase tracking-[0.3em]">+ Imóvel em destaque</a>
                <a href="{{ route('master.dashboard') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Dashboard</a>
            </div>
        </div>

        <div class="rounded-3xl border border-white/10 bg-white/5">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/10">
                    <thead>
                        <tr class="text-left text-xs font-semibold uppercase tracking-[0.3em] text-white/50">
                            <th class="px-6 py-4">Ordem</th>
                            <th class="px-6 py-4">Título</th>
                            <th class="px-6 py-4">Cidade/Estado</th>
                            <th class="px-6 py-4">Preço</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Atualizado</th>
                            <th class="px-6 py-4 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($featuredProperties as $property)
                            <tr class="text-sm text-white/80">
                                <td class="px-6 py-4 font-semibold text-white">{{ $property->display_order }}</td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <p class="font-semibold text-white">{{ $property->title }}</p>
                                        @if($property->short_description)
                                            <p class="text-xs uppercase tracking-[0.25em] text-white/50">{{ $property->short_description }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ $property->city }} • {{ $property->state }}</td>
                                <td class="px-6 py-4">{{ $property->price ? \App\Support\Format::currency($property->price) : 'Sob consulta' }}</td>
                                <td class="px-6 py-4">
                                    <span class="lux-badge-outline">{{ strtoupper($property->status) }}</span>
                                </td>
                                <td class="px-6 py-4 text-white/60">{{ $property->updated_at->diffForHumans() }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('master.featured-properties.edit', $property) }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Editar</a>
                                        <form action="{{ route('master.featured-properties.destroy', $property) }}" method="POST" onsubmit="return confirm('Remover este imóvel em destaque?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="lux-outline-button text-xs uppercase tracking-[0.3em] text-red-200 hover:text-white">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-sm text-white/60">Nenhum imóvel em destaque cadastrado. Utilize o botão "+ Imóvel em destaque" para inaugurar a vitrine prime.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-3xl border border-amber-500/30 bg-amber-500/10 p-6 text-sm text-amber-100">
            <p><strong>Limite rígido:</strong> {{ $featuredProperties->count() }} / 16 imóveis em destaque ativos.</p>
            <p class="mt-2">Ao atingir o limite, exclua ou ajuste a ordem de exibição para liberar espaço. A seção prime aparece antes de qualquer outro conteúdo para investidores.</p>
        </div>
    </div>
</div>
@endsection
