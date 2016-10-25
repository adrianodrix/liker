<?php

namespace Liker\Units\Posts\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Liker\Domains\Posts\Models\Post;
use Liker\Support\Http\Controllers\Controller;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'auth:api']);
    }

    public function store(Request $request, Post $post)
    {
        try {
            $this->authorize('like', $post);

            $like = $post->likes()->firstOrNew([
                'user_id' => $request->user()->id
            ]);

            if ($like->exists) {
                return response(null, Response::HTTP_CONFLICT);
            }

            $like->save();

            return response(null, Response::HTTP_CREATED);
        } catch (AuthorizationException $e) {
            return response(null, Response::HTTP_UNAUTHORIZED);
        }
    }
}