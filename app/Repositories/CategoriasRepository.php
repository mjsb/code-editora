<?php

namespace App\Repositories;

use App\Criteria\CriteriaTrashedInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoriasRepository.
 *
 * @package namespace App\Repositories;
 */
interface CategoriasRepository extends RepositoryInterface, CriteriaTrashedInterface
{
    //
    public function listsWithMutators($column, $key = null);

}
