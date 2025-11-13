@extends('layouts.app')

@section('title', 'Planos Prime')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8 text-center">Escolha seu Plano Prime</h1>

        @if($currentSubscription)
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
                <p class="text-blue-800">
                    Você possui o plano <strong>{{ $currentSubscription->plan->name }}</strong> ativo até {{ $currentSubscription->end_date->format('d/m/Y') }}.
                    Escolha um novo plano abaixo para fazer upgrade ou trocar seu plano.
                </p>
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($plans as $plan)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden {{ $plan->slug === 'prime-quarterly' ? 'border-4 border-green-500' : '' }}">
                    @if($plan->slug === 'prime-quarterly')
                        <div class="bg-green-500 text-white text-center py-2 font-bold">
                            MAIS POPULAR
                        </div>
                    @endif
                    
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-2">{{ $plan->name }}</h3>
                        <div class="text-4xl font-bold mb-4 {{ $plan->slug === 'prime-monthly' ? 'text-blue-600' : ($plan->slug === 'prime-quarterly' ? 'text-green-600' : 'text-purple-600') }}">
                            R$ {{ number_format($plan->price, 2, ',', '.') }}
                            <span class="text-lg text-gray-600">/mês</span>
                        </div>
                        
                        <p class="text-gray-600 mb-6">{{ $plan->description }}</p>

                        <div class="space-y-3 mb-8">
                            @if($plan->property_limit)
                                <div class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    <span>Até {{ $plan->property_limit }} imóveis</span>
                                </div>
                            @else
                                <div class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    <span class="font-bold">Imóveis ilimitados</span>
                                </div>
                            @endif

                            @if($plan->highlight_limit > 0)
                                <div class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    <span>Elegível para curadoria Master (até {{ $plan->highlight_limit }} convites mensais para a vitrine prime)</span>
                                </div>
                            @endif

                            @if($plan->features)
                                @foreach($plan->features as $feature)
                                    <div class="flex items-start">
                                        <span class="text-green-500 mr-2">✓</span>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <form method="POST" action="{{ route('businessman.subscribe', $plan) }}">
                            @csrf
                            <button type="submit" class="w-full py-3 rounded-lg font-semibold transition duration-200 {{ $plan->slug === 'prime-quarterly' ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-600 hover:bg-blue-700' }} text-white">
                                @if($currentSubscription && $currentSubscription->plan->id === $plan->id)
                                    Plano Atual
                                @else
                                    Escolher Plano
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <p class="text-gray-600">
                Todos os planos incluem suporte técnico e acesso aos corretores prime.
            </p>
        </div>
    </div>
</div>
@endsection
