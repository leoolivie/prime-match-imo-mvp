@extends('layouts.app')

@section('title', 'Dashboard do Investidor')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Dashboard do Investidor</h1>

        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Buscas Salvas</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $searches->total() }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Leads Ativos</h3>
                <p class="text-3xl font-bold text-green-600">{{ $leads->total() }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <a href="{{ route('investor.search') }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-lg">
                    🔍 Nova Busca Prime
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">Meus Leads</h2>
            @if($leads->count() > 0)
                <div class="space-y-4">
                    @foreach($leads as $lead)
                        <div class="border rounded-lg p-4">
                            <h3 class="font-bold">{{ $lead->property->title }}</h3>
                            <p class="text-gray-600">{{ $lead->property->city }}, {{ $lead->property->state }}</p>
                            <p class="text-gray-700">R$ {{ number_format($lead->property->price, 2, ',', '.') }}</p>
                            <span class="inline-block mt-2 px-3 py-1 rounded-full text-sm {{ $lead->status === 'new' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($lead->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $leads->links() }}
                </div>
            @else
                <p class="text-gray-500">Você ainda não tem leads. Faça uma busca prime!</p>
            @endif
        </div>
    </div>
</div>
@endsection
