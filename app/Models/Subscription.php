<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'start_date',
        'end_date',
        'status',
        'cancelled_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'cancelled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->end_date >= now();
    }

    public function getRemainingPropertiesAttribute(): ?int
    {
        if ($this->plan->isUnlimited()) {
            return null;
        }

        $usedProperties = $this->user->properties()->count();
        return max(0, $this->plan->property_limit - $usedProperties);
    }
}
