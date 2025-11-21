<?php

namespace App\Services;

use App\Models\PrimeSearch;
use App\Models\Property;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class OpenAiPropertyMatchService
{
    public function generateRecommendations(int $minPrice): array
    {
        $investorProfiles = $this->loadInvestorProfiles($minPrice);
        $properties = $this->loadLuxuryProperties($minPrice);

        $aiResponse = null;
        $structuredMatches = [];

        if ($investorProfiles->isNotEmpty() && $properties->isNotEmpty()) {
            $aiResponse = $this->requestMatches($investorProfiles, $properties);
            $structuredMatches = $this->decodeMatches($aiResponse);
        }

        return [
            'investors' => $investorProfiles,
            'properties' => $properties,
            'raw_response' => $aiResponse,
            'matches' => $structuredMatches,
        ];
    }

    protected function loadInvestorProfiles(int $minPrice): Collection
    {
        return PrimeSearch::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'investor')->where('active', true);
            })
            ->where(function ($query) use ($minPrice) {
                $query->where('min_price', '>=', $minPrice)
                    ->orWhere('max_price', '>=', $minPrice);
            })
            ->latest()
            ->take(10)
            ->get()
            ->map(function (PrimeSearch $search) {
                return [
                    'investor' => [
                        'id' => $search->user->id,
                        'name' => $search->user->name,
                        'email' => $search->user->email,
                        'phone' => $search->user->phone,
                    ],
                    'preferences' => [
                        'property_type' => $search->property_type,
                        'transaction_type' => $search->transaction_type,
                        'city' => $search->city,
                        'state' => $search->state,
                        'budget' => [
                            'min' => (int) ($search->min_price ?? 0),
                            'max' => (int) ($search->max_price ?? 0),
                        ],
                        'minimums' => [
                            'bedrooms' => $search->min_bedrooms ?? null,
                            'bathrooms' => $search->min_bathrooms ?? null,
                            'area' => $search->min_area ?? null,
                        ],
                        'features' => $this->normalizeFeatures($search->features),
                        'alert_opt_in' => $search->create_alert,
                    ],
                ];
            });
    }

    protected function loadLuxuryProperties(int $minPrice): Collection
    {
        return Property::with('owner')
            ->where('active', true)
            ->where('status', 'available')
            ->where('price', '>=', $minPrice)
            ->orderByDesc('highlighted')
            ->orderByDesc('price')
            ->take(15)
            ->get()
            ->map(function (Property $property) {
                return [
                    'id' => $property->id,
                    'title' => $property->title,
                    'city' => $property->city,
                    'state' => $property->state,
                    'price' => (int) ($property->price ?? 0),
                    'type' => $property->type,
                    'transaction_type' => $property->transaction_type,
                    'bedrooms' => $property->bedrooms ?? null,
                    'bathrooms' => $property->bathrooms ?? null,
                    'area' => $property->area ?? null,
                    'features' => $this->normalizeFeatures($property->features),
                    'owner' => $property->owner?->name,
                ];
            });
    }

    protected function requestMatches(Collection $investors, Collection $properties): ?string
    {
        $apiKey = config('services.openai.key');
        $baseUrl = rtrim(config('services.openai.base_url', 'https://api.openai.com/v1'), '/');
        $model = config('services.openai.model', 'gpt-4o-mini');

        if (!$apiKey) {
            throw new RuntimeException('Configure OPENAI_API_KEY no .env ou provedor antes de usar o agente.');
        }

        $payload = [
            'model' => $model,
            'response_format' => [
                'type' => 'json_schema',
                'json_schema' => [
                    'name' => 'property_matches',
                    'schema' => [
                        'type' => 'object',
                        'properties' => [
                            'matches' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'investor_id' => ['type' => 'number'],
                                        'property_id' => ['type' => 'number'],
                                        'fit_reason' => ['type' => 'string'],
                                    ],
                                    'required' => ['investor_id', 'property_id', 'fit_reason'],
                                ],
                            ],
                            'summary' => ['type' => 'string'],
                        ],
                        'required' => ['matches', 'summary'],
                        'additionalProperties' => false,
                    ],
                ],
            ],
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Você é um agente que cruza investidores de imóveis de alto padrão com imóveis disponíveis. Retorne correspondências em JSON, priorizando orçamento e localização.',
                ],
                [
                    'role' => 'user',
                    'content' => json_encode([
                        'investors' => $investors,
                        'properties' => $properties,
                    ]),
                ],
            ],
        ];

        $response = Http::baseUrl($baseUrl)
            ->withToken($apiKey)
            ->acceptJson()
            ->timeout(15)
            ->post('/chat/completions', $payload);

        if ($response->failed()) {
            throw new RuntimeException('OpenAI request failed: ' . $response->body());
        }

        return $response->json('choices.0.message.content');
    }

    protected function decodeMatches(?string $content): array
    {
        if (!$content) {
            return [];
        }

        $decoded = json_decode($content, true);

        if (!is_array($decoded)) {
            return [];
        }

        return [
            'summary' => $decoded['summary'] ?? null,
            'matches' => $decoded['matches'] ?? [],
        ];
    }

    protected function normalizeFeatures(mixed $features): array
    {
        if (is_array($features)) {
            return $features;
        }

        if (is_string($features)) {
            $decoded = json_decode($features, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }

        return [];
    }
}
