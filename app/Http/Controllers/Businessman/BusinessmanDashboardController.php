<?php

namespace App\Http\Controllers\Businessman;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\TelemetryMetric;
use App\Services\TelemetryRecorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessmanDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $properties = Property::where('user_id', $user->id)
            ->with('primaryImage')
            ->orderByDesc('highlighted')
            ->latest()
            ->paginate(6);

        $propertyIds = $properties->pluck('id')->all();
        $metricsTotal = TelemetryMetric::totalsForProperties($propertyIds, ['view_imovel', 'click_whatsapp_concierge']);
        $metrics7 = TelemetryMetric::totalsForProperties($propertyIds, ['view_imovel', 'click_whatsapp_concierge'], 7);
        $metrics30 = TelemetryMetric::totalsForProperties($propertyIds, ['view_imovel', 'click_whatsapp_concierge'], 30);

        $properties->getCollection()->transform(function (Property $property) use ($metricsTotal, $metrics7, $metrics30) {
            $views30 = $metrics30[$property->id]['view_imovel'] ?? 0;
            $clicks30 = $metrics30[$property->id]['click_whatsapp_concierge'] ?? 0;

            $property->dashboard_metrics = [
                'views7' => $metrics7[$property->id]['view_imovel'] ?? 0,
                'views30' => $views30,
                'clicks' => $metricsTotal[$property->id]['click_whatsapp_concierge'] ?? 0,
                'clicks30' => $clicks30,
                'conversion' => $views30 > 0 ? round(($clicks30 / $views30) * 100, 1) : 0,
            ];

            return $property;
        });

        $subscription = $user->activeSubscription;

        $stats = [
            'total_properties' => Property::where('user_id', $user->id)->count(),
            'active_properties' => Property::where('user_id', $user->id)->where('active', true)->count(),
            'visits_30' => array_reduce($metrics30, fn ($carry, $metrics) => $carry + ($metrics['view_imovel'] ?? 0), 0),
            'clicks_30' => array_reduce($metrics30, fn ($carry, $metrics) => $carry + ($metrics['click_whatsapp_concierge'] ?? 0), 0),
        ];
        $stats['conversion'] = $stats['visits_30'] > 0 ? round(($stats['clicks_30'] / $stats['visits_30']) * 100, 1) : 0;

        return view('businessman.dashboard', compact('properties', 'subscription', 'stats'));
    }

    public function plans()
    {
        $plans = SubscriptionPlan::where('active', true)->get();
        $currentSubscription = Auth::user()->activeSubscription;

        return view('businessman.plans', compact('plans', 'currentSubscription'));
    }

    public function subscribe(SubscriptionPlan $plan)
    {
        $user = Auth::user();

        // Cancel any existing active subscriptions
        Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->update(['status' => 'cancelled', 'cancelled_at' => now()]);

        // Calculate end date based on period
        $endDate = match ($plan->period) {
            'monthly' => now()->addMonth(),
            'quarterly' => now()->addMonths(3),
            'annual' => now()->addYear(),
            default => now()->addMonth(),
        };

        // Create new subscription
        Subscription::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $plan->id,
            'start_date' => now(),
            'end_date' => $endDate,
            'status' => 'active',
        ]);

        return redirect()->route('businessman.dashboard')
            ->with('success', 'Assinatura ativada com sucesso!');
    }

    public function properties()
    {
        $user = Auth::user();
        $properties = Property::where('user_id', $user->id)
            ->with('primaryImage')
            ->orderByDesc('highlighted')
            ->latest()
            ->paginate(12);

        $propertyIds = $properties->pluck('id')->all();
        $metrics30 = TelemetryMetric::totalsForProperties($propertyIds, ['view_imovel', 'click_whatsapp_concierge'], 30);

        $properties->getCollection()->transform(function (Property $property) use ($metrics30) {
            $views30 = $metrics30[$property->id]['view_imovel'] ?? 0;
            $clicks30 = $metrics30[$property->id]['click_whatsapp_concierge'] ?? 0;

            $property->dashboard_metrics = [
                'views30' => $views30,
                'clicks30' => $clicks30,
                'conversion' => $views30 > 0 ? round(($clicks30 / $views30) * 100, 1) : 0,
            ];

            return $property;
        });

        return view('businessman.properties', compact('properties'));
    }

    public function createProperty()
    {
        $user = Auth::user();
        $subscription = $user->activeSubscription;

        // Check if user can add more properties
        if ($subscription && !$subscription->plan->isUnlimited()) {
            if ($subscription->remaining_properties <= 0) {
                return redirect()->route('businessman.plans')
                    ->with('error', 'Você atingiu o limite de imóveis do seu plano. Faça upgrade!');
            }
        }

        return view('businessman.property-create');
    }

    public function storeProperty(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:apartment,house,commercial,land,other',
            'transaction_type' => 'required|in:sale,rent,both',
            'price' => 'required|numeric|min:0',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string|size:2',
            'zip_code' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|numeric|min:0',
            'registration_number' => 'nullable|string',
            'parking' => 'nullable|integer|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . now()->year,
            'highlighted' => 'sometimes|boolean',
        ]);

        $action = $request->input('action', 'save');

        $property = Property::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'description' => $data['description'],
            'type' => $data['type'],
            'transaction_type' => $data['transaction_type'],
            'price' => $data['price'],
            'address' => $data['address'] ?? null,
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'] ?? null,
            'bedrooms' => $data['bedrooms'] ?? null,
            'bathrooms' => $data['bathrooms'] ?? null,
            'area' => $data['area'] ?? null,
            'registration_number' => $data['registration_number'] ?? null,
            'highlighted' => $request->boolean('highlighted'),
            'features' => $this->buildFeatures($request),
            'status' => 'available',
            'active' => $action === 'publish',
        ]);

        // Handle images
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $images = array_slice($images, 0, 6);
            foreach ($images as $i => $img) {
                $path = $img->store('properties/' . $property->id, 'public');
                $property->images()->create([
                    'path' => $path,
                    'is_primary' => $i === 0,
                    'order' => $i,
                ]);
            }
        }

        // Handle video
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $vpath = $video->store('properties/videos/' . $property->id, 'public');
            $property->update(['video_url' => $vpath]);
        }

        if ($property->highlighted) {
            app(TelemetryRecorder::class)->record('highlight_toggle', [
                'property_id' => $property->id,
                'user_type' => 'empresario',
                'context' => 'cadastro',
            ], [
                'highlighted' => true,
            ]);
        }

        if ($action === 'preview') {
            return redirect()->route('properties.show', ['property' => $property, 'preview' => 1])
                ->with('success', 'Imóvel salvo como rascunho para pré-visualização.');
        }

        return redirect()->route('businessman.properties')
            ->with('success', $action === 'publish' ? 'Imóvel publicado e enviado para a vitrine!' : 'Rascunho salvo com sucesso.');
    }

    public function editProperty(Property $property)
    {
        $this->authorize('update', $property);

        return view('businessman.property-edit', compact('property'));
    }

    public function updateProperty(Request $request, Property $property)
    {
        $this->authorize('update', $property);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:apartment,house,commercial,land,other',
            'transaction_type' => 'required|in:sale,rent,both',
            'price' => 'required|numeric|min:0',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|size:2',
            'zip_code' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|numeric|min:0',
            'parking' => 'nullable|integer|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . now()->year,
            'highlighted' => 'sometimes|boolean',
            'status' => 'nullable|in:available,reserved,sold,rented',
            'active' => 'sometimes|boolean',
        ]);

        $action = $request->input('action', 'save');
        $originalHighlight = $property->highlighted;

        $property->update(array_merge($data, [
            'registration_number' => $request->registration_number,
            'highlighted' => $request->boolean('highlighted', $property->highlighted),
            'features' => $this->buildFeatures($request),
            'active' => $action === 'publish' ? true : ($request->has('active') ? $request->boolean('active') : $property->active),
            'status' => $data['status'] ?? $property->status,
        ]));

        // Handle new images (append, limit to 6)
        if ($request->hasFile('images')) {
            $existing = $property->images()->count();
            $images = $request->file('images');
            $allowed = max(0, 6 - $existing);
            $images = array_slice($images, 0, $allowed);
            foreach ($images as $i => $img) {
                $path = $img->store('properties/' . $property->id, 'public');
                $property->images()->create([
                    'path' => $path,
                    'is_primary' => false,
                    'order' => $existing + $i,
                ]);
            }
        }

        // Handle video replacement
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $vpath = $video->store('properties/videos/' . $property->id, 'public');
            $property->update(['video_url' => $vpath]);
        }

        if ($originalHighlight !== $property->highlighted) {
            app(TelemetryRecorder::class)->record('highlight_toggle', [
                'property_id' => $property->id,
                'user_type' => 'empresario',
                'context' => 'painel',
            ], [
                'highlighted' => $property->highlighted,
            ]);
        }

        if ($action === 'preview') {
            return redirect()->route('properties.show', ['property' => $property, 'preview' => 1])
                ->with('success', 'Pré-visualização atualizada.');
        }

        return redirect()->route('businessman.properties')->with('success', $action === 'publish' ? 'Imóvel publicado com sucesso!' : 'Imóvel atualizado com sucesso!');
    }

    public function destroyProperty(Property $property)
    {
        $this->authorize('delete', $property);

        $property->delete();

        return redirect()->route('businessman.properties')->with('success', 'Imóvel excluído com sucesso!');
    }

    protected function buildFeatures(Request $request): array
    {
        return array_filter([
            'vagas' => $request->input('parking'),
            'ano' => $request->input('year_built'),
        ], fn ($value) => !is_null($value) && $value !== '');
    }
}
