<?php

namespace App\Providers;

use App\Models\Place;
use App\Observers\PlaceObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Place::observe(PlaceObserver::class);
    }
}
