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
}
