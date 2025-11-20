<?php

namespace App\Http\Controllers;

use App\Models\FeaturedProperty;
use App\Models\Property;
use App\Models\TelemetryMetric;
use App\Services\TelemetryRecorder;
use App\Support\ConciergeLink;
use App\Support\Format;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class PropertyCatalogController extends Controller
{
    public function investor(Request $request, TelemetryRecorder $telemetry)
    {
        $filters = $this->parseFilters($request);

        $propertiesQuery = Property::query()
            ->with(['primaryImage', 'images'])
            ->where('active', true)
            ->where('status', 'available');

        if ($filters['city']) {
            $propertiesQuery->where('city', $filters['city']);
        }

        if ($filters['type']) {
            $propertiesQuery->where('type', $filters['type']);
        }

        if ($filters['price_min']) {
            $propertiesQuery->where('price', '>=', $filters['price_min']);
        }

        if ($filters['price_max']) {
            $propertiesQuery->where('price', '<=', $filters['price_max']);
        }

        if ($filters['bedrooms']) {
            $propertiesQuery->where('bedrooms', '>=', $filters['bedrooms']);
        }

        if ($filters['area_min']) {
            $propertiesQuery->where('area', '>=', $filters['area_min']);
        }

        $sort = $filters['sort'] ?? 'latest';
        $propertiesQuery = match ($sort) {
            'price_desc' => $propertiesQuery->orderByDesc('price'),
            'price_asc' => $propertiesQuery->orderBy('price'),
            'area_desc' => $propertiesQuery->orderByDesc('area'),
            default => $propertiesQuery->latest(),
        };

        $properties = $propertiesQuery->paginate(9)->withQueryString();

        if ($request->query()) {
            $telemetry->record('filter_apply', [
                'user_type' => 'investidor',
                'context' => 'catalogo',
            ], Arr::only($filters, [
                'city', 'type', 'price_min', 'price_max', 'bedrooms', 'area_min', 'sort',
            ]));
        }

        $featured = FeaturedProperty::where('status', 'available')
            ->orderBy('display_order')
            ->orderByDesc('created_at')
            ->take(16)
            ->get();

        $cities = Property::query()
            ->where('active', true)
            ->where('status', 'available')
            ->select('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        return view('investor.catalog', [
            'properties' => $properties,
            'featured' => $featured,
            'cities' => $cities,
            'filters' => $filters,
        ]);
    }

    public function show(Property $property, Request $request, TelemetryRecorder $telemetry)
    {
        $isPreview = $request->boolean('preview');
        $canPreview = $isPreview && auth()->check() && (auth()->user()->id === $property->user_id || auth()->user()->isMaster());

        if (!($property->active && $property->status === 'available')) {
            abort_unless($canPreview, 404);
        }

        if (!$isPreview) {
            $telemetry->record('view_imovel', [
                'property_id' => $property->id,
                'user_type' => 'investidor',
                'context' => $request->query('source', 'catalogo'),
            ]);
        }

        $gallery = $property->images()->orderBy('is_primary', 'desc')->get();

        $amenities = collect($property->features ?? [])->take(12);

        $metrics = [
            'views7' => TelemetryMetric::sumForProperty($property->id, 'view_imovel', 7),
            'views30' => TelemetryMetric::sumForProperty($property->id, 'view_imovel', 30),
            'clicks' => TelemetryMetric::sumForProperty($property->id, 'click_whatsapp_concierge'),
        ];

        return view('investor.show', [
            'property' => $property,
            'gallery' => $gallery,
            'amenities' => $amenities,
            'metrics' => $metrics,
            'isPreview' => $isPreview,
        ]);
    }

    public function primeSearch(Request $request)
    {
        $validated = $request->validate([
            'city' => 'nullable|string|max:255',
            'type' => 'nullable|string|in:apartment,house,commercial,land,other',
            'budget_min' => 'nullable|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:255',
            'urgency' => 'nullable|string|max:255',
            'details' => 'nullable|string|max:1000',
        ]);

        $budgetMin = array_key_exists('budget_min', $validated) ? $validated['budget_min'] : null;
        $budgetMax = array_key_exists('budget_max', $validated) ? $validated['budget_max'] : null;

        $budgetMin = is_null($budgetMin) ? null : (float) $budgetMin;
        $budgetMax = is_null($budgetMax) ? null : (float) $budgetMax;

        if (!is_null($budgetMin) && !is_null($budgetMax) && $budgetMin > $budgetMax) {
            [$budgetMin, $budgetMax] = [$budgetMax, $budgetMin];
        }

        $properties = Property::query()
            ->with('primaryImage')
            ->where('active', true)
            ->where('status', 'available');

        if (!empty($validated['city'])) {
            $properties->where('city', 'like', '%' . $validated['city'] . '%');
        }

        if (!empty($validated['type'])) {
            $properties->where('type', $validated['type']);
        }

        if (!is_null($budgetMin)) {
            $properties->where('price', '>=', $budgetMin);
        }

        if (!is_null($budgetMax)) {
            $properties->where('price', '<=', $budgetMax);
        }

        if (!empty($validated['tags'])) {
            $properties->where(function ($query) use ($validated) {
                foreach ($validated['tags'] as $tag) {
                    $query->whereJsonContains('features', $tag);
                }
            });
        }

        $matches = $properties
            ->latest()
            ->take(5)
            ->get()
            ->map(function (Property $property) {
                $imagePath = optional($property->primaryImage)->path;
                $image = $imagePath
                    ? '/public/' . ltrim($imagePath, '/')
                    : asset('images/placeholders/luxury-property.svg');

                return [
                    'id' => $property->id,
                    'title' => $property->title,
                    'city' => $property->city,
                    'state' => $property->state,
                    'type' => $property->type,
                    'price' => $property->price,
                    'price_formatted' => Format::currency($property->price),
                    'area' => $property->area,
                    'area_formatted' => $property->area ? Format::area($property->area) : null,
                    'bedrooms' => $property->bedrooms,
                    'bathrooms' => $property->bathrooms,
                    'features' => array_values(array_filter($property->features ?? [])),
                    'highlighted' => false,
                    'image_url' => $image,
                    'detail_url' => route('properties.show', ['property' => $property, 'source' => 'busca_prime']),
                    'concierge_url' => ConciergeLink::forInvestorCard($property),
                ];
            });

        return response()->json([
            'matches' => $matches,
        ]);
    }

    protected function parseFilters(Request $request): array
    {
        $priceRange = match ($request->query('price_range')) {
            '0-5' => [0, 5000000],
            '5-10' => [5000000, 10000000],
            '10-20' => [10000000, 20000000],
            '20+' => [20000000, null],
            default => [null, null],
        };

        return [
            'city' => $request->query('city'),
            'type' => $request->query('type'),
            'price_min' => $priceRange[0],
            'price_max' => $priceRange[1],
            'bedrooms' => $request->integer('bedrooms'),
            'area_min' => $request->integer('area_min'),
            'sort' => $request->query('sort'),
        ];
    }
}
