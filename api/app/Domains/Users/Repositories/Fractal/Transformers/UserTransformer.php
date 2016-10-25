<?php

namespace Liker\Domains\Users\Repositories\Fractal\Transformers;


use League\Fractal\TransformerAbstract;
use Liker\Domains\Posts\Repositories\Fractal\Transformers\PostTransformer;
use Liker\Domains\Users\Models\User;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['posts'];

    public function transform(User $model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'email' => $model->email,
            'avatar' => $model->avatar
        ];
    }

    public function includePosts(User $model)
    {
        return $this->collection($model->posts, new PostTransformer());
    }
}