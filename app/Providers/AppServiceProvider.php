<?php

namespace App\Providers;

use App\Models\Websites;
use App\Observers\WebsitesObserver;
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
        Websites::observe(WebsitesObserver::class);
    }
}
