<?php

namespace MSMS;

use Illuminate\Support\ServiceProvider;

class SMSBroadcastServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(abstract:SMSBroadcast::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
    }
}
