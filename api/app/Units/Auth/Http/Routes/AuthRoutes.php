<?php

namespace Liker\Units\Auth\Http\Routes;

use Liker\Support\Http\Routing\RouteFile;

class AuthRoutes extends RouteFile
{
    /**
     * Define Routes
     */
    protected function routes()
    {
        $this->router->get('/', [
            'as' => 'test.test',
            'uses' => 'TestController@test'
        ]);
    }
}