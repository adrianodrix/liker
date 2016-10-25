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
        /*
         * Public Routes
         */
        $this->router->get('/',                 'TestController@test');
        $this->router->post('auth/signin',      'LoginController@signin');
        $this->router->post('auth/register',    'RegisterController@register');

        /*
         * Private Routes
         */
        $this->router->group(['middleware' => ['auth:api']], function () {
            $this->router->get('auth/me', 'RegisterController@me');
        });
    }
}