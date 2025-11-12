<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\TelemetryMetric;
use App\Services\TelemetryRecorder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

        $featured = Property::with(['primaryImage'])
            ->where('active', true)
            ->where('status', 'available')
            ->where(function ($query) {
                $query->where('highlighted', true)
                    ->orWhereNotNull('highlighted_until');
            })
            ->orderByDesc('highlighted_until')
            ->take(6)
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
