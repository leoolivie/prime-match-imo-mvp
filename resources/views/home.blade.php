@extends('layouts.app')

@section('title', 'Prime Match Imo - Encontre seu imóvel ideal')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-4">Prime Match Imo</h1>
        <p class="text-2xl mb-8">Conectando investidores aos melhores imóveis</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-8 py-3 rounded-lg text-lg font-semibold">
                Começar Agora
            </a>
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-400 text-white px-8 py-3 rounded-lg text-lg font-semibold">
                Entrar
            </a>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Como Funciona</h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- For Investors -->
            <div class="bg-blue-50 p-6 rounded-lg">
                <div class="text-blue-600 text-5xl mb-4">👨‍💼</div>
                <h3 class="text-xl font-bold mb-3">Para Investidores</h3>
                <ul class="space-y-2 text-gray-700">
                    <li>✓ Busca Prime de imóveis</li>
                    <li>✓ Alertas personalizados</li>
                    <li>✓ Corretor prime dedicado</li>
                    <li>✓ Análise de investimento</li>
                </ul>
            </div>

            <!-- For Businessmen -->
            <div class="bg-green-50 p-6 rounded-lg">
                <div class="text-green-600 text-5xl mb-4">🏢</div>
                <h3 class="text-xl font-bold mb-3">Para Empresários</h3>
                <ul class="space-y-2 text-gray-700">
                    <li>✓ Planos flexíveis</li>
                    <li>✓ Gestão de imóveis</li>
                    <li>✓ Leads qualificados</li>
                    <li>✓ Destaque de imóveis</li>
                </ul>
            </div>

            <!-- For Brokers -->
            <div class="bg-purple-50 p-6 rounded-lg">
                <div class="text-purple-600 text-5xl mb-4">🎯</div>
                <h3 class="text-xl font-bold mb-3">Corretores Prime</h3>
                <ul class="space-y-2 text-gray-700">
                    <li>✓ Leads exclusivos</li>
                    <li>✓ CRM integrado</li>
                    <li>✓ Contato via WhatsApp</li>
                    <li>✓ Métricas de performance</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Subscription Plans -->
<div class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Planos Prime</h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Monthly Plan -->
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold mb-2">Prime Mensal</h3>
                <div class="text-4xl font-bold text-blue-600 mb-4">R$ 350<span class="text-lg text-gray-600">/mês</span></div>
                <ul class="space-y-3 mb-6">
                    <li>✓ Até 5 imóveis</li>
                    <li>✓ Corretor prime</li>
                    <li>✓ Suporte básico</li>
                    <li>✓ Consultoria</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
                    Começar Agora
                </a>
            </div>

            <!-- Quarterly Plan -->
            <div class="bg-white p-8 rounded-lg shadow-lg border-4 border-green-500 relative">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-1 rounded-full text-sm font-bold">
                    POPULAR
                </div>
                <h3 class="text-2xl font-bold mb-2">Prime Trimestral</h3>
                <div class="text-4xl font-bold text-green-600 mb-4">R$ 250<span class="text-lg text-gray-600">/mês</span></div>
                <ul class="space-y-3 mb-6">
                    <li>✓ Até 15 imóveis</li>
                    <li>✓ Corretor prime</li>
                    <li>✓ Suporte avançado</li>
                    <li>✓ Rede de parceiros</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold">
                    Começar Agora
                </a>
            </div>

            <!-- Annual Plan -->
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold mb-2">Prime Anual</h3>
                <div class="text-4xl font-bold text-purple-600 mb-4">R$ 200<span class="text-lg text-gray-600">/mês</span></div>
                <ul class="space-y-3 mb-6">
                    <li>✓ Imóveis ilimitados</li>
                    <li>✓ 1 destaque/mês</li>
                    <li>✓ Todos os benefícios</li>
                    <li>✓ Suporte premium</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold">
                    Começar Agora
                </a>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-blue-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Pronto para começar?</h2>
        <p class="text-xl mb-8">Junte-se a centenas de investidores e empresários que já confiam na Prime Match Imo</p>
        <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-8 py-3 rounded-lg text-lg font-semibold inline-block">
            Criar Conta Grátis
        </a>
    </div>
</div>
@endsection
