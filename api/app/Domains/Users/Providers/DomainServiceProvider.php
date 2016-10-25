<?php

namespace Liker\Domains\Users\Providers;


use Illuminate\Support\ServiceProvider;
use Liker\Domains\Users\Database\Factories\UserFactory;
use Liker\Domains\Users\Repositories\Contracts\UserRepository;
use Liker\Domains\Users\Repositories\Eloquent\UserRepositoryEloquent;

class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRepositories();
        $this->registerFactories();
    }

    public function registerRepositories()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
    }

    public function registerFactories()
    {
        (new UserFactory())->define();
    }
}