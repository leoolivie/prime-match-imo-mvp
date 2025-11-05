<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PrimeSearch;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $searches = PrimeSearch::where('user_id', $user->id)
            ->latest()
            ->paginate(10);
            
        $leads = Lead::where('investor_id', $user->id)
            ->with(['property', 'primeBroker'])
            ->latest()
            ->paginate(10);

        return view('investor.dashboard', compact('searches', 'leads'));
    }

    public function search()
    {
        return view('investor.search');
    }

    public function searchResults(Request $request)
    {
        $query = Property::where('active', true)
            ->where('status', 'available');

        if ($request->filled('property_type') && $request->property_type !== 'any') {
            $query->where('type', $request->property_type);
        }

        if ($request->filled('transaction_type') && $request->transaction_type !== 'both') {
            $query->where(function ($q) use ($request) {
                $q->where('transaction_type', $request->transaction_type)
                  ->orWhere('transaction_type', 'both');
            });
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('min_bedrooms')) {
            $query->where('bedrooms', '>=', $request->min_bedrooms);
        }

        if ($request->filled('min_bathrooms')) {
            $query->where('bathrooms', '>=', $request->min_bathrooms);
        }

        if ($request->filled('min_area')) {
            $query->where('area', '>=', $request->min_area);
        }

        $properties = $query->with(['primaryImage', 'owner'])
            ->latest()
            ->paginate(12);

        // Save search if requested
        if ($request->filled('create_alert') && $request->create_alert) {
            PrimeSearch::create([
                'user_id' => Auth::id(),
                'property_type' => $request->property_type ?? 'any',
                'transaction_type' => $request->transaction_type ?? 'both',
                'city' => $request->city,
                'state' => $request->state,
                'min_price' => $request->min_price,
                'max_price' => $request->max_price,
                'min_bedrooms' => $request->min_bedrooms,
                'min_bathrooms' => $request->min_bathrooms,
                'min_area' => $request->min_area,
                'create_alert' => true,
            ]);
        }

        return view('investor.search-results', compact('properties'));
    }

    public function createLead(Property $property)
    {
        $user = Auth::user();

        // Check if lead already exists
        $existingLead = Lead::where('property_id', $property->id)
            ->where('investor_id', $user->id)
            ->first();

        if ($existingLead) {
            return redirect()->back()->with('info', 'Você já demonstrou interesse neste imóvel.');
        }

        // Create new lead
        Lead::create([
            'property_id' => $property->id,
            'investor_id' => $user->id,
            'status' => 'new',
        ]);

        return redirect()->back()->with('success', 'Interesse registrado! Um corretor prime entrará em contato em breve.');
    }
}
