@extends('layouts.app')

@section('title', 'IA - Cruzamento de investidores e imóveis')

@section('content')
<div class="py-12">
    <div class="lux-container space-y-10">
        <header class="lux-card-dark space-y-6">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div class="space-y-3">
                    <span class="lux-badge-gold">Agente IA</span>
                    <h1 class="font-poppins text-3xl font-semibold text-white">Cruzar investidores de alto padrão com imóveis disponíveis</h1>
                    <p class="text-white/70 max-w-3xl">O painel consulta o MySQL (PrimeSearch e imóveis ativos), envia o contexto para a API da OpenAI e retorna as melhores combinações para o master avaliar.</p>
                </div>
                <form method="GET" class="flex items-end gap-3">
                    <label class="text-white/70 text-sm space-y-2">
                        <span>Ticket mínimo (R$)</span>
                        <input name="min_price" type="number" step="50000" min="0" value="{{ $minPrice }}" class="lux-input" />
                    </label>
                    <button type="submit" class="lux-gold-button">Atualizar</button>
                </form>
            </div>
            <div class="flex flex-wrap gap-3 text-xs text-white/60">
                <span class="lux-badge-muted">MySQL ativos: {{ $investors->count() }} perfis x {{ $properties->count() }} imóveis</span>
                <span class="lux-badge-muted">Modelo: {{ config('services.openai.model', 'gpt-4o-mini') }}</span>
                <span class="lux-badge-muted">Endpoint: {{ config('services.openai.base_url', 'https://api.openai.com/v1') }}</span>
            </div>
        </header>

        @if($error)
            <div class="lux-card border border-red-500/40 bg-red-500/10 text-red-200">
                <div class="flex justify-between items-start gap-4">
                    <div>
                        <p class="font-semibold">Não foi possível contatar a OpenAI</p>
                        <p class="text-sm">{{ $error }}</p>
                    </div>
                    <span class="text-xs uppercase tracking-[0.2em]">Action</span>
                </div>
            </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-[1.4fr_1fr]">
            <div class="lux-card space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Investidores elegíveis</h2>
                    <span class="lux-badge-muted">PrimeSearch (>= R$ {{ number_format($minPrice, 0, ',', '.') }})</span>
                </div>
                @if($investors->isEmpty())
                    <p class="text-white/60">Nenhum investidor de alto padrão encontrado com este ticket.</p>
                @else
                    <div class="grid gap-3 md:grid-cols-2">
                        @foreach($investors as $profile)
                            <div class="lux-card-dark space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-white">{{ $profile['investor']['name'] }}</span>
                                    <span class="lux-badge-muted">ID {{ $profile['investor']['id'] }}</span>
                                </div>
                                <p class="text-white/70 text-sm">{{ $profile['investor']['email'] }} @if($profile['investor']['phone']) · {{ $profile['investor']['phone'] }} @endif</p>
                                <dl class="grid grid-cols-2 gap-2 text-sm text-white/80">
                                    <div><dt class="text-white/50">Tipo</dt><dd>{{ ucfirst($profile['preferences']['property_type']) }}</dd></div>
                                    <div><dt class="text-white/50">Operação</dt><dd>{{ ucfirst($profile['preferences']['transaction_type']) }}</dd></div>
                                    <div><dt class="text-white/50">Local</dt><dd>{{ $profile['preferences']['city'] }}, {{ strtoupper($profile['preferences']['state']) }}</dd></div>
                                    <div><dt class="text-white/50">Orçamento</dt><dd>R$ {{ number_format($profile['preferences']['budget']['min'], 0, ',', '.') }} — R$ {{ number_format($profile['preferences']['budget']['max'], 0, ',', '.') }}</dd></div>
                                </dl>
                                <div class="text-xs text-white/60">
                                    <span class="lux-badge-muted">Quartos mín.: {{ $profile['preferences']['minimums']['bedrooms'] ?? '—' }}</span>
                                    <span class="lux-badge-muted">Banheiros mín.: {{ $profile['preferences']['minimums']['bathrooms'] ?? '—' }}</span>
                                    <span class="lux-badge-muted">Área mín.: {{ $profile['preferences']['minimums']['area'] ?? '—' }} m²</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="lux-card space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Imóveis de luxo ativos</h2>
                    <span class="lux-badge-muted">Filtro: preço >= R$ {{ number_format($minPrice, 0, ',', '.') }}</span>
                </div>
                @if($properties->isEmpty())
                    <p class="text-white/60">Nenhum imóvel disponível no critério.</p>
                @else
                    <div class="space-y-3 max-h-[520px] overflow-auto pr-1">
                        @foreach($properties as $property)
                            <div class="lux-card-dark space-y-1">
                                <div class="flex items-center justify-between">
                                    <div class="space-y-1">
                                        <p class="font-semibold text-white">{{ $property['title'] }}</p>
                                        <p class="text-white/60 text-sm">{{ $property['city'] }}, {{ strtoupper($property['state']) }} · {{ ucfirst($property['type']) }} · {{ ucfirst($property['transaction_type']) }}</p>
                                    </div>
                                    <div class="text-right text-white">
                                        <p class="text-lg font-semibold">R$ {{ number_format($property['price'], 0, ',', '.') }}</p>
                                        <p class="text-xs text-white/50">ID {{ $property['id'] }}</p>
                                    </div>
                                </div>
                                <div class="text-xs text-white/60 flex flex-wrap gap-2">
                                    <span class="lux-badge-muted">{{ $property['bedrooms'] }} quartos</span>
                                    <span class="lux-badge-muted">{{ $property['bathrooms'] }} banheiros</span>
                                    <span class="lux-badge-muted">{{ $property['area'] }} m²</span>
                                    @if(!empty($property['owner']))
                                        <span class="lux-badge-muted">{{ $property['owner'] }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="lux-card space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-white">Respostas da IA</h2>
                    <p class="text-white/60 text-sm">A listagem abaixo traz o JSON sugerido pelo modelo, sempre priorizando orçamento, localização e requisitos mínimos.</p>
                </div>
                <span class="lux-badge-gold">Output estruturado</span>
            </div>

            @if(isset($matches['summary']))
                <div class="lux-card-dark text-white/80 space-y-2">
                    <p class="text-sm uppercase tracking-[0.25em] text-white/50">Resumo</p>
                    <p>{{ $matches['summary'] }}</p>
                </div>
            @endif

            @if(!empty($matches['matches']))
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/10">
                        <thead class="text-left text-white/60 text-sm">
                            <tr>
                                <th class="py-2 pr-4">Investidor</th>
                                <th class="py-2 pr-4">Imóvel</th>
                                <th class="py-2">Racional</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-white/80">
                            @foreach($matches['matches'] as $match)
                                <tr>
                                    <td class="py-2 pr-4">ID {{ $match['investor_id'] }}</td>
                                    <td class="py-2 pr-4">ID {{ $match['property_id'] }}</td>
                                    <td class="py-2">{{ $match['fit_reason'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-white/60">Nenhuma correspondência retornada (verifique chave, dados ou ticket mínimo).</p>
            @endif

            @if($rawResponse)
                <div class="space-y-2">
                    <p class="text-white/60 text-sm">Payload bruto retornado:</p>
                    <pre class="bg-black/40 text-white/80 p-4 rounded-lg overflow-auto text-sm">{{ $rawResponse }}</pre>
                </div>
            @endif
        </div>

        <div class="lux-card-dark text-white/70 space-y-2 text-sm">
            <p class="font-semibold text-white">Como configurar a chave da OpenAI</p>
            <ol class="list-decimal list-inside space-y-1">
                <li>Obtenha sua chave na <a href="https://platform.openai.com/api-keys" class="lux-link">página de API Keys</a>.</li>
                <li>No arquivo <code>.env</code>, defina <code>OPENAI_API_KEY="sua_chave"</code>. Opcionalmente ajuste <code>OPENAI_MODEL</code> e <code>OPENAI_API_BASE</code>.</li>
                <li>Se estiver usando Docker ou hospedagem, exporte a variável no ambiente ou no provider (ex.: painel da cloud).</li>
                <li>Reimplante ou reinicie o PHP-FPM para que a aplicação leia a variável.</li>
            </ol>
            <p class="text-white/50">A configuração também pode ser feita com <code>export OPENAI_API_KEY="..."</code> no shell antes de executar <code>php artisan serve</code> ou os comandos do worker.</p>
        </div>
    </div>
</div>
@endsection
