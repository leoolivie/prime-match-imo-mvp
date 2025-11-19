<?php

namespace App\Http\Controllers;

use App\Models\FeaturedProperty;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured = FeaturedProperty::where('status', 'available')
            ->orderBy('display_order')
            ->orderByDesc('created_at')
            ->take(16)
            ->get();

        return view('home', compact('featured'));
    }

    public function investor()
    {
        $featured = FeaturedProperty::where('status', 'available')
            ->orderBy('display_order')
            ->orderByDesc('created_at')
            ->take(16)
            ->get();

        return view('landing.investor', compact('featured'));
    }

    public function businessman()
    {
        return view('landing.businessman');
    }

    public function master()
    {
        return view('landing.master');
    }

    public function sponsors()
    {
        $partners = Partner::where('active', true)->orderBy('name')->get();

        return view('sponsors.index', compact('partners'));
    }

    public function opportunities()
    {
        $mentors = [
            [
                'name' => 'Fernanda Ribeiro',
                'role' => 'Estrategista de aquisições',
                'description' => '15 anos liderando turnarounds imobiliários e aquisições cross-border.',
                'youtube_url' => 'https://www.youtube.com/watch?v=oF5lt-CVzlY',
                'avatar_url' => asset('images/placeholders/luxury-property.svg'),
            ],
            [
                'name' => 'Eduardo Meirelles',
                'role' => 'Especialista em investimentos imobiliários',
                'description' => 'Curador de fundos exclusivos e mentor de alocações patrimoniais.',
                'youtube_url' => 'https://www.youtube.com/watch?v=BzMLA8YIgG0',
                'avatar_url' => asset('images/placeholders/luxury-property.svg'),
            ],
            [
                'name' => 'Lara Couto',
                'role' => 'Head de corporate real estate',
                'description' => 'Integra parceiros estratégicos e operações complexas para empresários.',
                'youtube_url' => 'https://www.youtube.com/watch?v=ysz5S6PUM-U',
                'avatar_url' => asset('images/placeholders/luxury-property.svg'),
            ],
        ];

        $partners = [
            [
                'name' => 'Ademicon Private',
                'category' => 'Crédito e consórcio estruturado',
                'description' => 'Modelagem financeira sob medida para liberar capital rápido e barato.',
                'logo' => asset('images/placeholders/luxury-property.svg'),
            ],
            [
                'name' => 'Seguros Aurora Prime',
                'category' => 'Seguradora de imóveis de alto padrão',
                'description' => 'Proteção integral com apólices tailor-made para operações premium.',
                'logo' => asset('images/placeholders/luxury-property.svg'),
            ],
            [
                'name' => 'Atlas Due Diligence',
                'category' => 'Auditoria jurídica e regulatória',
                'description' => 'Validação jurídica completa para empresários e investidores com pressa.',
                'logo' => asset('images/placeholders/luxury-property.svg'),
            ],
            [
                'name' => 'Studio Sculp',
                'category' => 'Arquitetura & staging',
                'description' => 'Reposiciona imóveis premium em até 10 dias para acelerar visitas.',
                'logo' => asset('images/placeholders/luxury-property.svg'),
            ],
        ];

        $opportunities = [
            [
                'slug' => 'cobertura-jardins',
                'title' => 'Cobertura triplex com vista 270º',
                'location' => 'São Paulo · Jardins',
                'city' => 'São Paulo',
                'value_range' => '15m-25m',
                'value_range_label' => 'R$ 15M — R$ 25M',
                'asset_type' => 'residencial',
                'asset_label' => 'Residencial de alto padrão',
                'profile_focus' => 'investor',
                'image' => asset('images/investor/property-novalima.svg'),
                'asking_price' => 'R$ 18.500.000',
                'market_price' => 'R$ 21.000.000',
                'discount_percentage' => 12,
                'description' => 'Penthouse entregue com projeto assinado e concierge exclusivo para visitas aéreas.',
                'visit_date' => '26 de junho · 10h',
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
        ];

        $insights = [
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
        ];

        $heroMetrics = [
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
        ];

        $cityFilters = collect($opportunities)->pluck('city')->unique()->values();
        $rangeFilters = collect($opportunities)
            ->mapWithKeys(fn ($item) => [$item['value_range'] => $item['value_range_label']])
            ->unique()
            ->map(fn ($label, $value) => ['value' => $value, 'label' => $label])
            ->values();
        $typeFilters = collect($opportunities)
            ->mapWithKeys(fn ($item) => [$item['asset_type'] => $item['asset_label']])
            ->unique()
            ->map(fn ($label, $value) => ['value' => $value, 'label' => $label])
            ->values();

        return view('landing.opportunities', compact(
            'mentors',
            'partners',
            'opportunities',
            'insights',
            'heroMetrics',
            'cityFilters',
            'rangeFilters',
            'typeFilters'
        ));
    }
}
