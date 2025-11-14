<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The database connection used by the model.
     */
    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'whatsapp',
        'terms_accepted',
        'terms_accepted_at',
        'active',
        'creci',
        'cpf_cnpj',
        'businessman_state',
        'property_access_requested_at',
        'property_access_granted_at',
        'can_manage_properties',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'terms_accepted' => 'boolean',
        'terms_accepted_at' => 'datetime',
        'active' => 'boolean',
        'property_access_requested_at' => 'datetime',
        'property_access_granted_at' => 'datetime',
        'can_manage_properties' => 'boolean',
    ];

    public function setBusinessmanStateAttribute(?string $value): void
    {
        $this->attributes['businessman_state'] = $value ? strtoupper($value) : null;
    }

    public function setCpfCnpjAttribute(?string $value): void
    {
        $this->attributes['cpf_cnpj'] = $value ? preg_replace('/\D+/', '', $value) : null;
    }

    // Role checks
    public function isInvestor(): bool
    {
        return $this->role === 'investor';
    }

    public function isBusinessman(): bool
    {
        return $this->role === 'businessman';
    }

    public function isPrimeBroker(): bool
    {
        return $this->role === 'prime_broker';
    }

    public function isMaster(): bool
    {
        return $this->role === 'master';
    }

    public function hasApprovedPropertyAccess(): bool
    {
        return (bool) $this->can_manage_properties;
    }

    public function hasPendingPropertyAccessRequest(): bool
    {
        return $this->isBusinessman()
            && !$this->hasApprovedPropertyAccess()
            && !is_null($this->property_access_requested_at);
    }

    // Relationships
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->where('end_date', '>=', now());
    }

    public function primeSearches()
    {
        return $this->hasMany(PrimeSearch::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'investor_id');
    }

    public function brokerLeads()
    {
        return $this->hasMany(Lead::class, 'prime_broker_id');
    }
}

