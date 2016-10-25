<?php

namespace Liker\Domains\Posts\Repositories\Fractal\Presenters;


use Liker\Domains\Posts\Repositories\Fractal\Transformers\PostTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class PostPresenter extends FractalPresenter
{

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PostTransformer();
    }
}