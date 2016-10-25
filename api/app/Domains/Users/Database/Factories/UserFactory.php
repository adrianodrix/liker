<?php

namespace Liker\Domains\Users\Database\Factories;

use Liker\Domains\Users\Models\User;
use Liker\Support\Database\ModelFactory;

class UserFactory extends ModelFactory
{
    protected $model = User::class;

    /**
     * Return fields with values
     * @return array
     */
    protected function fields()
    {
        static $password;

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $password ?: $password = bcrypt('secret'),
            'remember_token' => str_random(10),
        ];
    }
}