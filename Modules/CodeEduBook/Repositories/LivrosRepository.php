<?php

namespace CodeEduBook\Repositories;

use App\Criteria\CriteriaTrashedInterface;
use App\Repositories\RepositoryRestoreInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LivrosRepository.
 *
 * @package namespace App\Repositories;
 */
interface LivrosRepository extends RepositoryInterface, RepositoryCriteriaInterface, CriteriaTrashedInterface, RepositoryRestoreInterface
{
    //
}
