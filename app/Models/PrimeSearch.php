<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimeSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_type',
        'transaction_type',
        'city',
        'state',
        'min_price',
        'max_price',
        'min_bedrooms',
        'min_bathrooms',
        'min_area',
        'features',
        'create_alert',
    ];

    protected $casts = [
        'features' => 'array',
        'create_alert' => 'boolean',
        'min_price' => 'decimal:2',
        'max_price' => 'decimal:2',
        'min_area' => 'decimal:2',
        'min_bedrooms' => 'integer',
        'min_bathrooms' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matchesProperty(Property $property): bool
    {
        // Type check
        if ($this->property_type !== 'any' && $this->property_type !== $property->type) {
            return false;
        }

        // Transaction type check
        if ($this->transaction_type !== 'both' && $this->transaction_type !== $property->transaction_type) {
            if ($property->transaction_type !== 'both') {
                return false;
            }
        }

        // Location check
        if ($this->city && strtolower($this->city) !== strtolower($property->city)) {
            return false;
        }

        if ($this->state && strtolower($this->state) !== strtolower($property->state)) {
            return false;
        }

        // Price range check
        if ($this->min_price && $property->price < $this->min_price) {
            return false;
        }

        if ($this->max_price && $property->price > $this->max_price) {
            return false;
        }

        // Bedrooms check
        if ($this->min_bedrooms && $property->bedrooms < $this->min_bedrooms) {
            return false;
        }

        // Bathrooms check
        if ($this->min_bathrooms && $property->bathrooms < $this->min_bathrooms) {
            return false;
        }

        // Area check
        if ($this->min_area && $property->area < $this->min_area) {
            return false;
        }

        return true;
    }
}
