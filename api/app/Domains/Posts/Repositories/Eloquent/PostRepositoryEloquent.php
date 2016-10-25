<?php

namespace Liker\Domains\Posts\Repositories\Eloquent;


use Liker\Domains\Posts\Models\Post;
use Liker\Domains\Posts\Repositories\Contracts\PostRepository;
use Liker\Domains\Posts\Repositories\Fractal\Presenters\PostPresenter;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;
use Prettus\Validator\Contracts\ValidatorInterface;

class PostRepositoryEloquent extends BaseRepository implements PostRepository, CacheableInterface
{
    use CacheableRepository;

    /**
     * Fields for search
     *
     * @var array
     */
    protected $fieldSearchable = [
        'body'  => 'like',
    ];

    /**
     * Validator Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'body' => 'required'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'body' => 'sometimes|required'
        ],
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }

    public function presenter()
    {
        return PostPresenter::class;
    }
}