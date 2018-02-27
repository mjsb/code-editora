<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindByNameCriteria implements CriteriaInterface {
    /**
     * @var
     */
    private $name;

    /**
     * FindByNameCriteria constructor.
     */
    public function __construct($name)
    {

        $this->name = $name;

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
        return $model->where('name', 'LIKE', "%{$this->name}%");

    }
}
