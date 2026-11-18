<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Aturan kata sandi: minimal 8, huruf dan angka, dicek ke daftar kebocoran.
        Password::defaults(fn () => Password::min(8)
            );

        // Login: 5 kali per menit per kombinasi email dan IP.
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->input('email');
            return Limit::perMinute(5)->by($email . '|' . $request->ip());
        });

        // Daftar: 5 kali per menit per IP.
        RateLimiter::for('daftar', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        // Lupa dan reset kata sandi: 3 kali per menit per email dan IP.
        RateLimiter::for('reset', function (Request $request) {
            $email = (string) $request->input('email');
            return Limit::perMinute(3)->by($email . '|' . $request->ip());
        });
    }
}