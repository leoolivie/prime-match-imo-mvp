<?php

namespace App\Support;

class Format
{
    public static function currency(float|int|null $value): string
    {
        if ($value === null) {
            return 'Sob consulta';
        }

        return 'R$ ' . number_format((float) $value, 2, ',', '.');
    }

    public static function shortCurrency(float|int|null $value): string
    {
        if ($value === null) {
            return 'Sob consulta';
        }

        if ($value >= 1000000) {
            return 'R$ ' . number_format($value / 1000000, 1, ',', '.') . 'M';
        }

        if ($value >= 1000) {
            return 'R$ ' . number_format($value / 1000, 1, ',', '.') . 'K';
        }

        return self::currency($value);
    }

    public static function area(float|int|null $value): string
    {
        if ($value === null) {
            return 'N/D';
        }

        return number_format((float) $value, 0, ',', '.') . ' m²';
    }

    public static function integer(?int $value): string
    {
        return $value !== null ? (string) $value : 'N/D';
    }
}
