<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Logout;
use App\Models\SecurityLog;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Application bootstrapping. Locale is set via SetLocale middleware after session is started.
        RateLimiter::for('login', function ($request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('register', function ($request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('checkout', function ($request) {
            return Limit::perMinute(10)->by($request->ip());
        });

        RateLimiter::for('download', function ($request) {
            return Limit::perMinute(5)->by($request->ip());
        });
        Event::listen(Login::class, function (Login $event) {
            SecurityLog::create([
                'event_type' => 'auth.login',
                'user_id' => $event->user->id ?? null,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'endpoint' => request()->path(),
                'method' => request()->method(),
                'status' => 'success',
            ]);
        });

        Event::listen(Failed::class, function (Failed $event) {
            $email = $event->credentials['email'] ?? null;
            SecurityLog::create([
                'event_type' => 'auth.failed',
                'user_id' => $event->user->id ?? null,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'endpoint' => request()->path(),
                'method' => request()->method(),
                'status' => 'failed',
                'message' => 'Invalid credentials',
                'metadata' => $email ? ['email' => $email] : null,
            ]);
        });

        Event::listen(Logout::class, function (Logout $event) {
            SecurityLog::create([
                'event_type' => 'auth.logout',
                'user_id' => $event->user->id ?? null,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'endpoint' => request()->path(),
                'method' => request()->method(),
                'status' => 'success',
            ]);
        });
    }
}
