<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'description',
        'website',
        'contact_email',
        'contact_phone',
        'category',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
