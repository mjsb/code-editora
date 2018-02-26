<?php

namespace App\Repositories;

use App\Criteria\CriteriaTrashedInterface;
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
