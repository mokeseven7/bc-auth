<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class BigCommerceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Http::macro('token', function ($body) {
           return Http::withOptions(['debug' => true])->baseUrl('https://login.bigcommerce.com')->post('/oauth2/token', $body);
        });
    }
}
