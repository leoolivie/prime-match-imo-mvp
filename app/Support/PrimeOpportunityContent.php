<?php

namespace App\Support;

use App\Models\PrimeOpportunitySetting;

class PrimeOpportunityContent
{
    public static function get(): array
    {
        $defaults = static::defaults();

        return collect($defaults)
            ->map(fn ($default, $key) => PrimeOpportunitySetting::getValue($key, $default))
            ->toArray();
    }

    public static function update(array $payload): void
    {
        foreach ($payload as $key => $value) {
            PrimeOpportunitySetting::updateValue($key, $value);
        }
    }

    public static function defaults(): array
    {
        return [
            'hero' => [
                'badge' => 'Nova landpage Prime',
                'title' => 'Oportunidades Prime para Empresários e Investidores',
                'description' => 'Imóveis abaixo do preço de mercado, curadoria de mentores e parceiros estratégicos para acelerar suas negociações e visitas com até 10 investidores.',
                'support_text' => 'Conectamos negócios reais com inteligência Prime, visitas exclusivas e suporte especializado em cada etapa da negociação.',
                'businessman_cta_label' => 'Sou Empresário Prime',
                'investor_cta_label' => 'Sou Investidor Prime',
            ],
            'cta_card' => [
                'badge' => 'Agenda limitada',
                'title' => 'Visitas exclusivas com até 10 investidores',
                'description' => 'Selecione oportunidades com tag Destaque Prime para impulsionar campanhas pagas do empresário e liberar alertas VIP para investidores.',
                'steps' => [
                    ['label' => 'Diagnóstico com mentores Prime para validar desconto real vs. mercado.'],
                    ['label' => 'Ativação dos parceiros estratégicos para crédito, seguro e diligência.'],
                    ['label' => 'Visita com até 10 investidores e concierge conduzindo a disputa.'],
                ],
                'vip_title' => 'Lista VIP de investidores',
                'vip_description' => 'Investidores que optam por alertas relâmpago recebem prioridade nas agendas e podem ser ativados pelo empresário como upgrade pago.',
            ],
            'hero_metrics' => [
                [
                    'label' => 'Oportunidades validadas',
                    'value' => '82',
                    'description' => 'Somente negócios com desconto real comprovado.',
                ],
                [
                    'label' => 'Valor negociado',
                    'value' => 'R$ 480 Mi',
                    'description' => 'Volume transacionado com inteligência Prime.',
                ],
                [
                    'label' => 'Tempo médio de fechamento',
                    'value' => '18 dias',
                    'description' => 'Ao ativar concierge e parceiros estratégicos.',
                ],
            ],
            'mentors' => [
                [
                    'name' => 'Joana Leal',
                    'role' => 'Head de Investor Relations',
                    'description' => 'Opera rodadas com capital estrangeiro e lidera squads de pitch financeiro.',
                    'youtube_url' => '#',
                    'avatar_url' => asset('images/mentors/joana-leal.png'),
                ],
                [
                    'name' => 'Diego Taveira',
                    'role' => 'Concierge Prime',
                    'description' => 'Cria roteiros de visitas com até 10 investidores em 3 dias.',
                    'youtube_url' => '#',
                    'avatar_url' => asset('images/mentors/diego-taveira.png'),
                ],
                [
                    'name' => 'Camila Fabri',
                    'role' => 'CMO Prime Match Imo',
                    'description' => 'Testa narrativas comerciais com dados reais para provar desconto.',
                    'youtube_url' => '#',
                    'avatar_url' => asset('images/mentors/camila-fabri.png'),
                ],
            ],
            'partners' => [
                [
                    'name' => 'Ademicon Private',
                    'category' => 'Crédito estruturado',
                    'description' => 'Antecipação e fianças exclusivas para disputar ativos premium.',
                    'logo' => asset('images/partners/ademicon.png'),
                ],
                [
                    'name' => 'Seguros Aurora Prime',
                    'category' => 'Seguros',
                    'description' => 'Blindagem patrimonial e performance para investidores.',
                    'logo' => asset('images/partners/aurora.png'),
                ],
                [
                    'name' => 'Atlas Due Diligence',
                    'category' => 'Due diligence',
                    'description' => 'Dossiê jurídico e técnico com indicadores digitais.',
                    'logo' => asset('images/partners/atlas.png'),
                ],
                [
                    'name' => 'Conexão Prime Match',
                    'category' => 'Concierge',
                    'description' => 'Execução ponta a ponta com concierge dedicado.',
                    'logo' => asset('images/partners/prime.png'),
                ],
            ],
            'opportunities' => [
                [
                    'slug' => 'distrito-financeiro-higienopolis',
                    'title' => 'Distrito financeiro com contratos ativos',
                    'location' => 'São Paulo · Higienópolis',
                    'city' => 'São Paulo',
                    'value_range' => '15m-25m',
                    'value_range_label' => 'R$ 15M — R$ 25M',
                    'asset_type' => 'corporativo',
                    'asset_label' => 'Corporate & renda',
                    'profile_focus' => 'businessman',
                    'image' => asset('images/investor/property-corporate.svg'),
                    'asking_price' => 'R$ 22.500.000',
                    'market_price' => 'R$ 27.800.000',
                    'discount_percentage' => 19,
                    'description' => 'Lajes entregues com contratos triple net e upside de aluguel imediato.',
                    'visit_date' => '25 de junho · 10h',
                    'slots_total' => 10,
                    'slots_taken' => 7,
                    'vip_only' => true,
                    'premium' => true,
                    'partner_highlight' => 'Financie com Ademicon Private',
                ],
                [
                    'slug' => 'hub-corporativo-pinheiros',
                    'title' => 'Hub corporativo com contratos âncora',
                    'location' => 'São Paulo · Pinheiros',
                    'city' => 'São Paulo',
                    'value_range' => '25m+',
                    'value_range_label' => 'Acima de R$ 25M',
                    'asset_type' => 'corporativo',
                    'asset_label' => 'Corporate & renda',
                    'profile_focus' => 'businessman',
                    'image' => asset('images/investor/property-corporate.svg'),
                    'asking_price' => 'R$ 38.000.000',
                    'market_price' => 'R$ 45.000.000',
                    'discount_percentage' => 15,
                    'description' => 'Andares entregues com fit-out corporativo e contratos com reajuste em dólar.',
                    'visit_date' => '27 de junho · 9h',
                    'slots_total' => 10,
                    'slots_taken' => 5,
                    'vip_only' => false,
                    'premium' => true,
                    'partner_highlight' => 'Seguro locatício com Seguros Aurora Prime',
                ],
                [
                    'slug' => 'retiro-baleia',
                    'title' => 'Retiro pé na areia na Praia da Baleia',
                    'location' => 'Litoral Norte · Praia da Baleia',
                    'city' => 'Praia da Baleia',
                    'value_range' => '8m-15m',
                    'value_range_label' => 'R$ 8M — R$ 15M',
                    'asset_type' => 'residencial',
                    'asset_label' => 'Residencial com renda',
                    'profile_focus' => 'investor',
                    'image' => asset('images/investor/property-balneario.svg'),
                    'asking_price' => 'R$ 11.200.000',
                    'market_price' => 'R$ 13.900.000',
                    'discount_percentage' => 19,
                    'description' => 'Casa pronta para locações premium com concierge de praia e ROI projetado em 14%.',
                    'visit_date' => '29 de junho · 11h',
                    'slots_total' => 10,
                    'slots_taken' => 8,
                    'vip_only' => false,
                    'premium' => false,
                    'partner_highlight' => 'Proteção completa com Seguros Aurora Prime',
                ],
                [
                    'slug' => 'torre-botafogo',
                    'title' => 'Torre boutique em Botafogo',
                    'location' => 'Rio de Janeiro · Botafogo',
                    'city' => 'Rio de Janeiro',
                    'value_range' => '15m-25m',
                    'value_range_label' => 'R$ 15M — R$ 25M',
                    'asset_type' => 'corporativo',
                    'asset_label' => 'Corporate & renda',
                    'profile_focus' => 'businessman',
                    'image' => asset('images/investor/property-corporate.svg'),
                    'asking_price' => 'R$ 24.000.000',
                    'market_price' => 'R$ 28.500.000',
                    'discount_percentage' => 16,
                    'description' => 'Mix de escritórios boutique com rooftop privativo e contratos curados.',
                    'visit_date' => '30 de junho · 14h',
                    'slots_total' => 10,
                    'slots_taken' => 4,
                    'vip_only' => false,
                    'premium' => false,
                    'partner_highlight' => 'Due diligence completa com Atlas',
                ],
            ],
            'insights' => [
                [
                    'title' => 'Checklist para validar imóveis realmente abaixo do mercado',
                    'summary' => 'Aprenda quais métricas usar para provar desconto real antes da diligência.',
                    'url' => '#',
                ],
                [
                    'title' => 'Como preparar a visita exclusiva com até 10 investidores',
                    'summary' => 'Roteiros, materiais e argumentos que convertem na primeira reunião.',
                    'url' => '#',
                ],
                [
                    'title' => 'Sinais de alerta antes de assinar um contrato corporativo',
                    'summary' => 'Mentores Prime revelam cláusulas que preservam margem e velocidade.',
                    'url' => '#',
                ],
            ],
        ];
    }
}
