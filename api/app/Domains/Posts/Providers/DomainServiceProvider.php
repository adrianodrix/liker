<?php

namespace Liker\Domains\Posts\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Liker\Domains\Posts\Database\Factories\PostFactory;
use Liker\Domains\Posts\Models\Post;
use Liker\Domains\Posts\Policies\PostPolicy;
use Liker\Domains\Posts\Repositories\Contracts\PostRepository;
use Liker\Domains\Posts\Repositories\Eloquent\PostRepositoryEloquent;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];


    public function register()
    {
        $this->registerRepositories();
        $this->registerPolicies();
        $this->registerFactories();
    }

    public function registerFactories()
    {
        (new PostFactory())->define();
    }

    public function registerRepositories()
    {
        $this->app->bind(PostRepository::class, PostRepositoryEloquent::class);
    }

    /**
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

}