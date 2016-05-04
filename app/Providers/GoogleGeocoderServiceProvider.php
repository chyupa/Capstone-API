<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class GoogleGeocoderServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        App::bind('GoogleGeocoder', function () {
            return new \App\Capstone\GoogleGeocoder\GoogleGeocoder;
        });
    }
}