<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        // Eloquent stores attributes on the model; property_exists will return false.
        // Safely check the attribute value instead.
        if (!$user || !($user->is_admin ?? false)) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
