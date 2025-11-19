<?php

namespace App\Http\Controllers;

use App\Services\ConciergeMessageBuilder;
use App\Services\TelemetryRecorder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConciergeRedirectController extends Controller
{
    public function __invoke(
        Request $request,
        ConciergeMessageBuilder $messageBuilder,
        TelemetryRecorder $telemetry
    ): RedirectResponse {
        $context = $request->query('context', 'investidor_card');
        $payload = json_decode(base64_decode($request->query('payload', '')), true) ?? [];
        $propertyId = $request->query('property_id');
        $featuredPropertyId = $request->query('featured_property_id');
        $userType = $request->query('user_type');
        $source = $request->query('source');

        $metadata = [];
        if ($context === 'busca_prime') {
            $telemetry->record('busca_prime_submit', [
                'user_type' => 'investidor',
                'context' => $context,
                'source' => $source ?? 'catalog',
            ], [
                'city' => $payload['city'] ?? null,
                'type' => $payload['type'] ?? null,
                'budget_min' => $payload['budget_min'] ?? null,
                'budget_max' => $payload['budget_max'] ?? null,
            ]);
        }

        if ($propertyId) {
            $metadata['property_id'] = $propertyId;
        }

        if ($featuredPropertyId) {
            $metadata['featured_property_id'] = $featuredPropertyId;
        }

        $telemetry->record('click_whatsapp_concierge', [
            'property_id' => $propertyId,
            'user_type' => $userType,
            'context' => $context,
            'source' => $source,
        ], $metadata);

        $message = $messageBuilder->build($context, $payload);

        return redirect()->away('https://wa.me/5514996845854?text=' . rawurlencode($message));
    }
}
