<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App as Application;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->session()->get('locale', config('app.locale'));
        Application::setLocale($locale);
        // also set the html lang attribute via a header for client-side if needed
        $response = $next($request);
        return $response;
    }
}
