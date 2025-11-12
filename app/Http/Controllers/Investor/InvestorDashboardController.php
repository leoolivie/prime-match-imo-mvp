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
    public function index(Request $request)
    {
        $user = Auth::user();

        $searchQuery = PrimeSearch::where('user_id', $user->id)->latest();
        $leadBaseQuery = Lead::where('investor_id', $user->id);

        $metrics = [
            'searches' => (clone $searchQuery)->count(),
            'matches' => (clone $leadBaseQuery)->count(),
            'negotiations' => (clone $leadBaseQuery)->whereIn('status', ['negotiating', 'viewing_scheduled', 'viewing_done'])->count(),
        ];

        $leads = (clone $leadBaseQuery)
            ->with(['property.primaryImage', 'primeBroker'])
            ->latest()
            ->paginate(6);

        $searches = $searchQuery->take(6)->get();

        $featuredProperties = Property::with(['primaryImage', 'owner'])
            ->where('active', true)
            ->where('status', 'available')
            ->orderByDesc('highlighted')
            ->orderByDesc('highlighted_until')
            ->latest()
            ->take(6)
            ->get();

        $propertyFilters = Property::query()
            ->select('city')
            ->whereNotNull('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        $propertiesQuery = Property::with(['primaryImage', 'owner'])
            ->where('active', true)
            ->where('status', 'available');

        if ($request->filled('city') && $request->city !== 'todas') {
            $propertiesQuery->where('city', $request->city);
        }

        if ($request->filled('type') && $request->type !== 'todas') {
            $propertiesQuery->where('type', $request->type);
        }

        if ($request->filled('value_range') && $request->value_range !== 'todas') {
            [$min, $max] = match ($request->value_range) {
                'ate-1m' => [0, 1000000],
                '1-5m' => [1000000, 5000000],
                '5-10m' => [5000000, 10000000],
                '10m+' => [10000000, null],
                default => [null, null],
            };

            if (!is_null($min)) {
                $propertiesQuery->where('price', '>=', $min);
            }

            if (!is_null($max)) {
                $propertiesQuery->where('price', '<=', $max);
            }
        }

        $properties = $propertiesQuery
            ->orderByDesc('highlighted')
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('investor.dashboard', compact(
            'searches',
            'leads',
            'featuredProperties',
            'properties',
            'propertyFilters',
            'metrics',
        ));
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

    public function contactConcierge(Property $property)
    {
        $user = Auth::user();

        if (!$property->active || $property->status !== 'available') {
            return redirect()->back()->with('error', 'Este imóvel não está disponível no momento.');
        }

        $lead = Lead::firstOrCreate(
            [
                'property_id' => $property->id,
                'investor_id' => $user->id,
            ],
            [
                'status' => 'new',
            ]
        );

        $lead->update([
            'status' => 'contacted',
            'notes' => trim(($lead->notes ?? '') . "\nContato via concierge (WhatsApp) em " . now()->format('d/m/Y H:i')),
            'contacted_at' => now(),
        ]);

        $message = rawurlencode(
            sprintf(
                'Olá Prime Concierge, sou %s. Quero avançar com o imóvel %s em %s/%s (ID %d) anunciado por %s. Valor: R$ %s. Meu e-mail: %s. Obrigado!',
                $user->name,
                $property->title,
                $property->city,
                $property->state,
                $property->id,
                optional($property->owner)->name ?? 'Empresário Prime',
                number_format($property->price, 2, ',', '.'),
                $user->email
            )
        );

        return redirect()->away('https://wa.me/5514996845854?text=' . $message);
    }
}
