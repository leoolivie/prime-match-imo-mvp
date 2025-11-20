<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;

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
        if (static::$cache !== null) {
            return static::$cache;
        }

        $table = (new static())->getTable();

        if (! Schema::hasTable($table)) {
            return static::$cache = collect();
        }

        try {
            static::$cache = static::query()->get()->keyBy('key');
        } catch (QueryException $exception) {
            if ($exception->getCode() !== '42S02') {
                throw $exception;
            }

            // Table exists in code but is not present in the database yet.
            static::$cache = collect();
        }

        return static::$cache;
    }
}
