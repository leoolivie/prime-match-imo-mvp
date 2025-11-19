<?php

namespace App\Support;

use App\Models\PrimeOpportunitySetting;

class PrimeOpportunityContent
{
    public static function get(): array
    {
        $defaults = static::defaults();

        return collect($defaults)
            ->map(fn ($default, $key) => PrimeOpportunitySetting::getValue($key, $default))
            ->toArray();
    }

    public static function update(array $payload): void
    {
        foreach ($payload as $key => $value) {
            PrimeOpportunitySetting::updateValue($key, $value);
        }
    }

    public static function defaults(): array
    {
        return [
            'hero' => [
                'badge' => '',
                'title' => '',
                'description' => '',
                'support_text' => '',
                'businessman_cta_label' => '',
                'investor_cta_label' => '',
            ],
            'cta_card' => [
                'badge' => '',
                'title' => '',
                'description' => '',
                'steps' => [],
                'vip_title' => '',
                'vip_description' => '',
            ],
            'hero_metrics' => [],
            'mentors' => [],
            'partners' => [],
            'opportunities' => [],
            'insights' => [],
        ];
    }
}
