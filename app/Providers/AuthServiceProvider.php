<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\Client;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //Client Credentials ou Password Grant
        Passport::tokensExpireIn(now()->addMinutes(config('auth.passport.access_token_expire')));
        Passport::refreshTokensExpireIn(now()->addMinutes(config('auth.passport.refresh_token_expire')));
        //Personal Access Client loginOAuthPersonal
        Passport::personalAccessTokensExpireIn(now()->addMinutes(config('auth.passport.personal_token_expire')));
    }
}
