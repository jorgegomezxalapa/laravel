<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Carbon\Carbon;

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
        //
        \URL::forceScheme('https');

        \Carbon\Carbon::setLocale(config('app.locale'));

    }
}
