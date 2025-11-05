@extends('layouts.app')

@section('title', 'Dashboard do Corretor')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Dashboard do Corretor Prime</h1>

        <!-- Stats -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Total Leads</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['total_leads'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Novos</h3>
                <p class="text-3xl font-bold text-yellow-600">{{ $stats['new_leads'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Contatados</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $stats['contacted'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Fechados</h3>
                <p class="text-3xl font-bold text-green-600">{{ $stats['won'] }}</p>
            </div>
        </div>

        <!-- Leads Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold">Meus Leads</h2>
            </div>

            <div class="overflow-x-auto">
                @if($leads->count() > 0)
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imóvel</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Investidor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contato</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($leads as $lead)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-900">{{ $lead->property->title }}</p>
                                            <p class="text-gray-500">{{ $lead->property->city }}</p>
                                            <p class="text-gray-700 font-semibold">R$ {{ number_format($lead->property->price, 2, ',', '.') }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-900">{{ $lead->investor->name }}</p>
                                            <p class="text-gray-500">{{ $lead->investor->email }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($lead->investor->whatsapp)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->investor->whatsapp) }}" 
                                               target="_blank"
                                               class="inline-flex items-center text-green-600 hover:text-green-700">
                                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                                </svg>
                                                WhatsApp
                                            </a>
                                        @else
                                            <span class="text-gray-400">Não disponível</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            {{ $lead->status === 'new' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $lead->status === 'contacted' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $lead->status === 'won' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $lead->status === 'lost' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($lead->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $lead->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @if(!$lead->prime_broker_id)
                                            <form method="POST" action="{{ route('broker.lead.claim', $lead) }}">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-700 font-semibold">
                                                    Atribuir
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">Atribuído</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="p-6">
                        {{ $leads->links() }}
                    </div>
                @else
                    <div class="p-6 text-center text-gray-500">
                        Nenhum lead disponível no momento.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
