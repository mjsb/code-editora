<?php

namespace CodeEduBook\Repositories;

use App\Criteria\CriteriaTrashedTrait;
use App\Repositories\BaseRepositoryTrait;
use CodeEduBook\Repositories\CategoriasRepository;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Models\Categoria;

/**
 * Class CategoriasRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoriasRepositoryEloquent extends BaseRepository implements CategoriasRepository
{
    use BaseRepositoryTrait;
    use CriteriaTrashedTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Categoria::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function listsWithMutators($column, $key = null)
    {
        /** @var Collection $collection */
        $collection = $this->all();
        return $collection->pluck($column, $key);
    }

}
