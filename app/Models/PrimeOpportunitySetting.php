<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrimeOpportunitySetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'array',
    ];

    protected static ?Collection $cache = null;

    public static function getValue(string $key, $default = null)
    {
        $settings = static::allCached();

        return optional($settings->get($key))->value ?? $default;
    }

    public static function updateValue(string $key, $value): self
    {
        static::$cache = null;

        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    protected static function allCached(): Collection
    {
        if (static::$cache === null) {
            static::$cache = static::query()->get()->keyBy('key');
        }

        return static::$cache;
    }
}
