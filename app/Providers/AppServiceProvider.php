<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use URL;
use Config;
use Illuminate\Pagination\Paginator;

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
        URL::forceRootUrl(Config::get('app.url')); // これで .envに書いてあるAPP_URLを強制
        Paginator::useBootstrap();
    }
}
