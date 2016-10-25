<?php

namespace Liker\Units\Posts\Providers;


use Illuminate\Support\ServiceProvider;

class UnitServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}