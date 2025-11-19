<?php

namespace App\Http\Controllers;

use App\Models\FeaturedProperty;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Support\PrimeOpportunityContent;

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
        $content = PrimeOpportunityContent::get();

        $hero = $content['hero'];
        $ctaCard = $content['cta_card'];
        $heroMetrics = $content['hero_metrics'];
        $mentors = $content['mentors'];
        $partners = $content['partners'];
        $opportunities = $content['opportunities'];
        $insights = $content['insights'];

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
            'hero',
            'ctaCard',
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
