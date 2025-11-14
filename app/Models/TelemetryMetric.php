<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TelemetryMetric extends Model
{
    use HasFactory;

    /**
     * The database connection used by the model.
     */
    protected $connection = 'mysql';

    protected $fillable = [
        'event_name',
        'event_date',
        'property_id',
        'user_type',
        'context',
        'source',
        'metadata_hash',
        'metadata',
        'count',
    ];

    protected $casts = [
        'event_date' => 'date',
        'metadata' => 'array',
        'count' => 'integer',
    ];

    public static function incrementMetric(string $eventName, array $attributes = [], array $metadata = []): void
    {
        $eventDate = now()->toDateString();
        $metadata = self::sanitizeMetadata($metadata);
        $metadataHash = self::hashMetadata($metadata);

        $values = [
            'event_name' => $eventName,
            'event_date' => $eventDate,
            'property_id' => $attributes['property_id'] ?? null,
            'user_type' => $attributes['user_type'] ?? null,
            'context' => $attributes['context'] ?? null,
            'source' => $attributes['source'] ?? null,
            'metadata_hash' => $metadataHash,
        ];

        $update = [
            'metadata' => empty($metadata) ? null : $metadata,
            'updated_at' => now(),
        ];

        static::query()->updateOrCreate($values, $update);

        static::query()
            ->where($values)
            ->increment('count');
    }

    public static function sumForProperty(int $propertyId, string $eventName, ?int $days = null): int
    {
        return (int) static::query()
            ->where('property_id', $propertyId)
            ->where('event_name', $eventName)
            ->when($days, function ($query, $days) {
                $query->where('event_date', '>=', now()->subDays($days - 1)->toDateString());
            })
            ->sum('count');
    }

    public static function totalsForProperties(array $propertyIds, array $eventNames, ?int $days = null): array
    {
        if (empty($propertyIds) || empty($eventNames)) {
            return [];
        }

        return static::query()
            ->select('property_id', 'event_name', DB::raw('SUM(count) as total'))
            ->whereIn('property_id', $propertyIds)
            ->whereIn('event_name', $eventNames)
            ->when($days, function ($query, $days) {
                $query->where('event_date', '>=', now()->subDays($days - 1)->toDateString());
            })
            ->groupBy('property_id', 'event_name')
            ->get()
            ->groupBy('property_id')
            ->map(function (Collection $items) {
                return $items->mapWithKeys(fn ($item) => [$item->event_name => (int) $item->total])->all();
            })
            ->all();
    }

    public static function globalSum(string $eventName, ?int $days = null): int
    {
        return (int) static::query()
            ->where('event_name', $eventName)
            ->when($days, function ($query, $days) {
                $query->where('event_date', '>=', now()->subDays($days - 1)->toDateString());
            })
            ->sum('count');
    }

    protected static function sanitizeMetadata(array $metadata): array
    {
        ksort($metadata);

        return array_filter($metadata, fn ($value) => !is_null($value) && $value !== '');
    }

    protected static function hashMetadata(array $metadata): string
    {
        if (empty($metadata)) {
            return '0';
        }

        return hash('sha256', json_encode($metadata, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}
