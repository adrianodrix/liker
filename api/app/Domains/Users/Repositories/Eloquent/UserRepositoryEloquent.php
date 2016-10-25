<?php

namespace Liker\Domains\Users\Repositories\Eloquent;

use Liker\Domains\Users\Models\User;
use Liker\Domains\Users\Repositories\Contracts\UserRepository;
use Liker\Domains\Users\Repositories\Fractal\Presenters\UserPresenter;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;
use Prettus\Validator\Contracts\ValidatorInterface;

class UserRepositoryEloquent extends BaseRepository implements UserRepository, CacheableInterface
{
    use CacheableRepository;

    /**
     * Fields for search
     *
     * @var array
     */
    protected $fieldSearchable = [
        'name'  => 'like',
        'email',
    ];

    /**
     * Validator Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:255'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'name' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|unique:users',
            'password' => 'sometimes|required|min:8|max:255'
        ],
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }

    /**
     * Get Presenter Class
     *
     * @return string
     */
    public function presenter()
    {
        return UserPresenter::class;
    }
}