<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TwoFactor\TwoFactor;
use App\TwoFactor\Authy;
use GuzzleHttp\Client;

class TwoFactorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(TwoFactor::class, function () {
            return new Authy(new Client);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
