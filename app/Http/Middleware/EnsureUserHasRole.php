<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || empty($roles)) {
            abort(403);
        }

        if (!in_array($user->role, $roles, true)) {
            abort(403);
        }

        return $next($request);
    }
}
