<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\TelemetryMetric;
use App\Support\ConciergeLink;
use Illuminate\Support\Facades\Auth;

class BrokerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $views7 = TelemetryMetric::globalSum('view_imovel', 7);
        $views30 = TelemetryMetric::globalSum('view_imovel', 30);
        $conciergeClicks7 = TelemetryMetric::globalSum('click_whatsapp_concierge', 7);
        $conciergeClicks30 = TelemetryMetric::globalSum('click_whatsapp_concierge', 30);
        $primeSearch30 = TelemetryMetric::globalSum('busca_prime_submit', 30);

        $stats = [
            'views7' => $views7,
            'views30' => $views30,
            'conciergeClicks7' => $conciergeClicks7,
            'conciergeClicks30' => $conciergeClicks30,
            'buscaPrime30' => $primeSearch30,
            'conversion' => $views30 > 0 ? round(($conciergeClicks30 / $views30) * 100, 1) : 0,
        ];

        $properties = Property::query()
            ->with('primaryImage')
            ->where('active', true)
            ->where('status', 'available')
            ->orderByDesc('updated_at')
            ->take(12)
            ->get();

        $propertyMetrics = TelemetryMetric::totalsForProperties(
            $properties->pluck('id')->all(),
            ['view_imovel', 'click_whatsapp_concierge'],
            30
        );

        $properties->each(function (Property $property) use ($propertyMetrics) {
            $metrics = $propertyMetrics[$property->id] ?? [];
            $views = $metrics['view_imovel'] ?? 0;
            $clicks = $metrics['click_whatsapp_concierge'] ?? 0;

            $property->analytics = [
                'views30' => $views,
                'conciergeClicks30' => $clicks,
                'conversion' => $views > 0 ? round(($clicks / $views) * 100, 1) : 0,
            ];
        });

        $supportLink = ConciergeLink::forBrokerSupport();

        return view('broker.dashboard', [
            'user' => $user,
            'stats' => $stats,
            'properties' => $properties,
            'supportLink' => $supportLink,
        ]);
    }
}
