<?php

namespace App\Http\Controllers\Businessman;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessmanDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $properties = Property::where('user_id', $user->id)
            ->withCount('leads')
            ->latest()
            ->paginate(10);
            
        $subscription = $user->activeSubscription;
        
        $stats = [
            'total_properties' => $user->properties()->count(),
            'active_properties' => $user->properties()->where('active', true)->count(),
            'total_leads' => $user->properties()->withCount('leads')->get()->sum('leads_count'),
        ];

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
        $user->subscriptions()
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
            ->with(['primaryImage', 'leads'])
            ->latest()
            ->paginate(15);

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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:apartment,house,commercial,land,other',
            'transaction_type' => 'required|in:sale,rent,both',
            'price' => 'required|numeric|min:0',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|size:2',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|numeric|min:0',
            'registration_number' => 'nullable|string',
        ]);

        Property::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'transaction_type' => $request->transaction_type,
            'price' => $request->price,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'area' => $request->area,
            'registration_number' => $request->registration_number,
            'status' => 'available',
            'active' => true,
        ]);

        return redirect()->route('businessman.properties')
            ->with('success', 'Imóvel cadastrado com sucesso!');
    }
}
