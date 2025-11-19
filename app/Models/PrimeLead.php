<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimeLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile_type',
        'vip_opt_in',
        'source',
        'opportunity_reference',
        'meta',
    ];

    protected $casts = [
        'vip_opt_in' => 'boolean',
        'meta' => 'array',
    ];
}
