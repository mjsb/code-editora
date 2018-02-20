<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindByTitleCriteria implements CriteriaInterface {
    /**
     * @var
     */
    private $title;

    /**
     * FindByTitleCriteria constructor.
     */
    public function __construct($title)
    {

        $this->title = $title;

    }


    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */

    public function apply($model, RepositoryInterface $repository)
    {
        // TODO: Implement apply() method.
        return $model->where('title', 'LIKE', "%{$this->title}%");

    }
}
