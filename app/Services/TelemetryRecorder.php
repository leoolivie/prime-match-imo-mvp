<?php

namespace App\Services;

use App\Models\TelemetryMetric;

class TelemetryRecorder
{
    public function record(string $eventName, array $attributes = [], array $metadata = []): void
    {
        TelemetryMetric::incrementMetric($eventName, $attributes, $metadata);
    }
}
