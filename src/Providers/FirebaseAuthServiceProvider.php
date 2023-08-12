<?php

namespace Tots\FirebaseAuth\Providers;

use Illuminate\Support\ServiceProvider;
use Tots\FirebaseAuth\Services\FirebaseAuthService;

class FirebaseAuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register role singleton
        $this->app->singleton(FirebaseAuthService::class, function ($app) {
            return new FirebaseAuthService(config('firebase-auth'));
        });
    }

    /**
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
