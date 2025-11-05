@extends('layouts.app')

@section('title', 'Dashboard do Empresário')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Dashboard do Empresário</h1>
            <a href="{{ route('businessman.properties') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Ver Meus Imóveis
            </a>
        </div>

        <!-- Stats -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Total de Imóveis</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['total_properties'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Imóveis Ativos</h3>
                <p class="text-3xl font-bold text-green-600">{{ $stats['active_properties'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Total de Leads</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $stats['total_leads'] }}</p>
            </div>
        </div>

        <!-- Subscription Info -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Minha Assinatura</h2>
                <a href="{{ route('businessman.plans') }}" class="text-blue-600 hover:text-blue-700">
                    Ver Planos
                </a>
            </div>
            
            @if($subscription)
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg">{{ $subscription->plan->name }}</h3>
                            <p class="text-gray-600">Ativo até {{ $subscription->end_date->format('d/m/Y') }}</p>
                            <p class="text-sm text-gray-500 mt-2">
                                @if($subscription->plan->isUnlimited())
                                    Imóveis ilimitados
                                @else
                                    {{ $subscription->remaining_properties }} imóveis restantes de {{ $subscription->plan->property_limit }}
                                @endif
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-green-600">
                                R$ {{ number_format($subscription->plan->price, 2, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-600">/{{ $subscription->plan->period === 'monthly' ? 'mês' : ($subscription->plan->period === 'quarterly' ? 'trimestre' : 'ano') }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-yellow-800 mb-4">Você não possui uma assinatura ativa.</p>
                    <a href="{{ route('businessman.plans') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                        Escolher Plano
                    </a>
                </div>
            @endif
        </div>

        <!-- Recent Properties -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Imóveis Recentes</h2>
                <a href="{{ route('businessman.property.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    + Novo Imóvel
                </a>
            </div>

            @if($properties->count() > 0)
                <div class="space-y-4">
                    @foreach($properties as $property)
                        <div class="border rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">{{ $property->title }}</h3>
                                    <p class="text-gray-600">{{ $property->city }}, {{ $property->state }}</p>
                                    <p class="text-gray-700 font-semibold mt-1">R$ {{ number_format($property->price, 2, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block px-3 py-1 rounded-full text-sm {{ $property->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($property->status) }}
                                    </span>
                                    @if($property->leads_count > 0)
                                        <p class="text-sm text-gray-600 mt-2">
                                            {{ $property->leads_count }} {{ $property->leads_count === 1 ? 'lead' : 'leads' }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $properties->links() }}
                </div>
            @else
                <p class="text-gray-500">Você ainda não cadastrou nenhum imóvel.</p>
                <a href="{{ route('businessman.property.create') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                    Cadastrar Primeiro Imóvel
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
