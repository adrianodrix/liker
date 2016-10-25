<?php

namespace Liker\Domains\Users\Repositories\Fractal\Presenters;


use Liker\Domains\Users\Repositories\Fractal\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class UserPresenter extends FractalPresenter
{

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }
}