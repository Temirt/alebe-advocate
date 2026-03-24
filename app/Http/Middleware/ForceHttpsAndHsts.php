<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttpsAndHsts
{
    public function handle(Request $request, Closure $next)
    {
        if (!app()->environment('local')) {
            $forwardedProto = $request->header('x-forwarded-proto');
            $isSecure = $request->isSecure() || $forwardedProto === 'https';

            if (!$isSecure) {
                return redirect()->secure($request->getRequestUri());
            }
        }

        $response = $next($request);

        if (!app()->environment('local')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        return $response;
    }
}
