<?php

namespace YWatchman\ProxmoxMGW;

use Illuminate\Support\ServiceProvider;

class ProxmoxMGWServiceProvider extends ServiceProvider
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
        // Register routes
        include __DIR__ . '/routes.php';
    }
}
