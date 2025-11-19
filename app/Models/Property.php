<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The database connection used by the model.
     */
    protected $connection = 'mysql';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'transaction_type',
        'price',
        'address',
        'city',
        'state',
        'zip_code',
        'latitude',
        'longitude',
        'bedrooms',
        'bathrooms',
        'area',
        'registration_number',
        'features',
        'status',
        'highlighted',
        'highlighted_until',
        'active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'area' => 'decimal:2',
        'features' => 'array',
        'highlighted' => 'boolean',
        'highlighted_until' => 'datetime',
        'active' => 'boolean',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
    ];

    protected $hidden = [
        'registration_number', // Always hidden by default
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function isHighlighted(): bool
    {
        return $this->highlighted && 
               $this->highlighted_until && 
               $this->highlighted_until >= now();
    }

    public function canBeViewedBy(User $user): bool
    {
        // Master can view all
        if ($user->isMaster()) {
            return true;
        }

        // Owner can view their own
        if ($this->user_id === $user->id) {
            return true;
        }

        // Others can only view active properties
        return $this->active && $this->status === 'available';
    }

    public function registrationNumberVisibleTo(User $user): bool
    {
        // Only owner and master can see registration number
        return $user->isMaster() || $this->user_id === $user->id;
    }

    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'available' => 'Disponível',
            'reserved' => 'Reservado',
            'unavailable' => 'Indisponível',
        ];

        return $labels[$this->status] ?? ucfirst($this->status);
    }
}
