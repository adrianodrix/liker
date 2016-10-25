<?php

namespace Liker\Domains\Posts\Repositories\Fractal\Transformers;


use League\Fractal\TransformerAbstract;
use Liker\Domains\Posts\Models\Post;
use Liker\Domains\Users\Repositories\Fractal\Transformers\UserTransformer;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];

    public function transform(Post $model)
    {
        return [
            'id' => (int) $model->id,
            'body' => $model->body,
            'likeCount' => (int) $model->likeCount,
            'likedByCurrentUser' => (bool) $model->likedByCurrentUser,
            'canBeLike' => (bool) $model->canBeLike,
            'diffForHumans' => $model->created_at->diffForHumans()
        ];
    }

    public function includeUser(Post $model)
    {
        return $this->item($model->user, new UserTransformer());
    }
}