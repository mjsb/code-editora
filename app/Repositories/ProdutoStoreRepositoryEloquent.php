<?php

namespace App\Repositories;

use CodeEduBook\Repositories\LivroRepositoryEloquent;
use CodeEduStore\Models\ProductStore;
use CodeEduStore\Repositories\CategoriaRepository;
use CodeEduStore\Repositories\ProdutoRepository;

/**
 * Class CategoriaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProdutoStoreRepositoryEloquent extends LivroRepositoryEloquent implements ProdutoRepository
{
    private $categoriaRepository;

    public function home(){
        #return $this->model->where('published', 1)->paginate(12)->items();
        #return $this->model->where('published', 1)->take(12)->get();
        return $this->model->search("")->take(12)->get();
    }

    public function findByCategoria ($id)
    {
        // TODO: Implement findByCategoria() method.
        $categoria = $this->categoriaRepository->find($id);
        return $categoria->livros()->where('published', 1)->get();
    }

    public function boot ()
    {
        $this->categoriaRepository = app(CategoriaRepository::class);
        parent::boot(); // TODO: Change the autogenerated stub
    }

    public function like($search){
        #return $this->model->where('title','like',"%$search%")->where('published',1)->get();
        return $this->model->search($search)->get();
    }

    public function findBySlug($slug){
        return $this->model->findBySlugOrFail($slug);
    }

    public function makeProductStore($id){
        $produto = $this->find($id);
        $productStore = new ProductStore();
        $productStore->setId($produto->id)
            ->setName($produto->title)
            ->setPrice($produto->price)
            ->setProductOriginal($produto);
        return $productStore;
    }
}
