<?php

namespace App\Support;

use App\Models\FeaturedProperty;
use App\Models\Property;

class ConciergeLink
{
    public static function forInvestorCard(Property $property): string
    {
        return self::build('investidor_card', [
            'title' => $property->title,
            'city' => $property->city,
            'state' => $property->state,
            'type' => ucfirst($property->type),
            'price' => $property->price,
            'tags' => array_slice($property->features ?? [], 0, 3),
            'url' => route('properties.show', $property),
        ], [
            'property_id' => $property->id,
            'user_type' => 'investidor',
            'source' => 'card',
        ]);
    }

    public static function forInvestorDetail(Property $property): string
    {
        return self::build('investidor_detalhe', [
            'title' => $property->title,
            'city' => $property->city,
            'state' => $property->state,
            'price' => $property->price,
            'tags' => array_slice($property->features ?? [], 0, 5),
            'url' => route('properties.show', $property),
        ], [
            'property_id' => $property->id,
            'user_type' => 'investidor',
            'source' => 'detalhe',
        ]);
    }

    public static function forBusinessmanSupport(?Property $property = null): string
    {
        $payload = [];

        if ($property) {
            $payload = [
                'title' => $property->title,
                'city' => $property->city,
            ];
        }

        return self::build('empresario_duvida', $payload, [
            'property_id' => $property?->id,
            'user_type' => 'empresario',
            'source' => 'painel',
        ]);
    }

    public static function forBrokerSupport(?Property $property = null): string
    {
        $payload = [];

        if ($property) {
            $payload = [
                'title' => $property->title,
                'city' => $property->city,
                'state' => $property->state,
            ];
        }

        return self::build('broker_support', $payload, [
            'property_id' => $property?->id,
            'user_type' => 'prime_broker',
            'source' => 'painel_corretor',
        ]);
    }

    public static function build(string $context, array $payload = [], array $attributes = []): string
    {
        $query = array_filter([
            'context' => $context,
            'payload' => base64_encode(json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)),
            'property_id' => $attributes['property_id'] ?? null,
            'featured_property_id' => $attributes['featured_property_id'] ?? null,
            'user_type' => $attributes['user_type'] ?? null,
            'source' => $attributes['source'] ?? null,
        ]);

        return route('concierge.redirect', $query);
    }

    public static function forFeaturedProperty(FeaturedProperty $property, string $userType = 'investidor'): string
    {
        $context = $userType === 'empresario' ? 'empresario_duvida' : 'investidor_detalhe';

        $payload = [
            'title' => $property->title,
            'city' => $property->city,
            'state' => $property->state,
            'price' => $property->price,
            'url' => $property->cta_view_url ?? route('investor.catalog'),
            'tags' => ['Prime'],
        ];

        if ($property->status) {
            $payload['tags'][] = ucfirst($property->status);
        }

        return self::build($context, $payload, [
            'featured_property_id' => $property->id,
            'user_type' => $userType,
            'source' => 'destaque_prime',
        ]);
    }
}
