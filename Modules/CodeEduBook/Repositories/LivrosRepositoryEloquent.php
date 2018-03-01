<?php

namespace CodeEduBook\Repositories;

use App\Criteria\CriteriaTrashedTrait;
use App\Repositories\RepositoryRestoreTrait;
use CodeEduBook\Repositories\LivrosRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Models\Livro;

/**
 * Class LivrosRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LivrosRepositoryEloquent extends BaseRepository implements LivrosRepository
{
    use CriteriaTrashedTrait;
    use RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'title' => 'like',
        'author.name' => 'like',
        'categorias.name' => 'like'
    ];

    public function create(array $attributes)
    {
        $model = parent::create($attributes);
        $model->categorias()->sync($attributes['categorias']);
        return $model;
    }

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        $model->categorias()->sync($attributes['categorias']);
    }


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Livro::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
