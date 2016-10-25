<?php

namespace Liker\Units\Auth\Providers;


use Illuminate\Support\ServiceProvider;

class UnitServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(AuthServiceProvider::class);
        //$this->app->register(BroadcastServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }


}