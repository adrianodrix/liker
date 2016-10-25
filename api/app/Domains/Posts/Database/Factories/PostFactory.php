<?php

namespace Liker\Domains\Posts\Database\Factories;

use Liker\Domains\Posts\Models\Post;
use Liker\Support\Database\ModelFactory;

class PostFactory extends ModelFactory
{
    protected $model = Post::class;

    /**
     * Return fields with values
     * @return array
     */
    protected function fields()
    {
        return [
            'body' => $this->faker->sentence
        ];
    }
}