<?php

namespace Liker\Units\Posts\Http\Routes;

use Liker\Support\Http\Routing\RouteFile;

class PostRoutes extends RouteFile
{
    /**
     * Define Routes
     */
    protected function routes()
    {
        $this->router->resource('posts', 'PostController', ['only' => ['index', 'store', 'show']]);
        $this->router->post('posts/{post}/likes', 'PostLikeController@store');
    }
}