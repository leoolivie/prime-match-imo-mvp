<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Property::with(['primaryImage'])
            ->where('active', true)
            ->where('status', 'available')
            ->orderByDesc('highlighted')
            ->orderByDesc('highlighted_until')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featured'));
    }

    public function investor()
    {
        return view('landing.investor');
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
