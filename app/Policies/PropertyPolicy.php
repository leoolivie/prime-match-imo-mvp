<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    public function update(User $user, Property $property)
    {
        return $property->user_id === $user->id || $user->role === 'master';
    }

    public function delete(User $user, Property $property)
    {
        return $property->user_id === $user->id || $user->role === 'master';
    }
}
