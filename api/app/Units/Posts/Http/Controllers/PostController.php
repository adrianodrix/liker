<?php

namespace Liker\Units\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Liker\Domains\Posts\Models\Post;
use Liker\Domains\Posts\Repositories\Contracts\PostRepository;
use Liker\Domains\Posts\Repositories\Criterias\PostLatestFirstCriteria;
use Liker\Domains\Posts\Repositories\Fractal\Transformers\PostTransformer;
use Liker\Support\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * @var PostRepository
     */
    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->middleware(['auth', 'auth:api']);

        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(new PostLatestFirstCriteria());
        $response = $this->repository->paginate();
        return response()->json($response, Response::HTTP_OK);
    }

    public function show($post)
    {
        $post = $this->repository->find($post);
        return response()->json($post, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $post = $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return response()->json(
            fractal()
                ->item($post)
                ->transformWith(new PostTransformer())
                ->parseIncludes('user')
                ->toArray(),
            Response::HTTP_CREATED
        );
    }
}