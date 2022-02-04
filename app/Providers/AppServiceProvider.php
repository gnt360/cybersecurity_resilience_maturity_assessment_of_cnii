<?php

namespace App\Providers;

use App\Models\Organisation;
use App\Observers\OrganisationObserver;
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
        Organisation::observe(OrganisationObserver::class);
    }
}
