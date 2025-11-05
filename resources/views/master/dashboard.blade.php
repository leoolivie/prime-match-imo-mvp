@extends('layouts.app')

@section('title', 'Dashboard Master')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Dashboard Master</h1>

        <!-- Stats -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Total Usuários</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['total_users'] }}</p>
                <div class="mt-2 text-sm text-gray-600 space-y-1">
                    <p>Investidores: {{ $stats['investors'] }}</p>
                    <p>Empresários: {{ $stats['businessmen'] }}</p>
                    <p>Corretores: {{ $stats['brokers'] }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Imóveis</h3>
                <p class="text-3xl font-bold text-green-600">{{ $stats['total_properties'] }}</p>
                <p class="mt-2 text-sm text-gray-600">Ativos: {{ $stats['active_properties'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Assinaturas Ativas</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $stats['total_subscriptions'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Total Leads</h3>
                <p class="text-3xl font-bold text-yellow-600">{{ $stats['total_leads'] }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('master.users') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-lg shadow text-center">
                <div class="text-4xl mb-2">👥</div>
                <h3 class="font-bold text-lg">Gerenciar Usuários</h3>
            </a>
            <a href="{{ route('master.properties') }}" class="bg-green-600 hover:bg-green-700 text-white p-6 rounded-lg shadow text-center">
                <div class="text-4xl mb-2">🏢</div>
                <h3 class="font-bold text-lg">Gerenciar Imóveis</h3>
            </a>
            <a href="{{ route('master.partners') }}" class="bg-purple-600 hover:bg-purple-700 text-white p-6 rounded-lg shadow text-center">
                <div class="text-4xl mb-2">🤝</div>
                <h3 class="font-bold text-lg">Gerenciar Parceiros</h3>
            </a>
        </div>

        <!-- Recent Users -->
        <div class="bg-white rounded-lg shadow mb-8">
            <div class="p-6 border-b flex justify-between items-center">
                <h2 class="text-xl font-bold">Usuários Recentes</h2>
                <a href="{{ route('master.users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                    + Novo Usuário
                </a>
            </div>
            <div class="p-6">
                @if($recentUsers->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentUsers as $user)
                            <div class="flex justify-between items-center border-b pb-3">
                                <div>
                                    <p class="font-medium">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                                        {{ $user->role === 'investor' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $user->role === 'businessman' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $user->role === 'prime_broker' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $user->role === 'master' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                    </span>
                                    <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Nenhum usuário cadastrado ainda.</p>
                @endif
            </div>
        </div>

        <!-- Recent Properties -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold">Imóveis Recentes</h2>
            </div>
            <div class="p-6">
                @if($recentProperties->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentProperties as $property)
                            <div class="flex justify-between items-center border-b pb-3">
                                <div>
                                    <p class="font-medium">{{ $property->title }}</p>
                                    <p class="text-sm text-gray-600">{{ $property->city }}, {{ $property->state }}</p>
                                    <p class="text-sm text-gray-500">Proprietário: {{ $property->owner->name }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-green-600">R$ {{ number_format($property->price, 2, ',', '.') }}</p>
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium mt-1
                                        {{ $property->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($property->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Nenhum imóvel cadastrado ainda.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
