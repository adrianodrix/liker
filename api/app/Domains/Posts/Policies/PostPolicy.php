<?php

namespace Liker\Domains\Posts\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use Liker\Domains\Posts\Models\Post;
use Liker\Domains\Users\Models\User;

class PostPolicy
{

    use HandlesAuthorization;

    public function like(User $user, Post $post)
    {
        return $user->id !== $post->user->id;
    }
}