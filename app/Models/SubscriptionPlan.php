<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'period',
        'property_limit',
        'highlight_limit',
        'features',
        'active',
    ];

    protected $casts = [
        'features' => 'array',
        'active' => 'boolean',
        'price' => 'decimal:2',
        'property_limit' => 'integer',
        'highlight_limit' => 'integer',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function isUnlimited(): bool
    {
        return $this->property_limit === null;
    }
}
