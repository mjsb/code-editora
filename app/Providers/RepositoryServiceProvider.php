<?php

namespace App\Providers;

use App\Repositories\CategoriaStoreRepositoryEloquent;
use App\Repositories\ProdutoStoreRepositoryEloquent;
use CodeEduStore\Repositories\CategoriaRepository;
use CodeEduStore\Repositories\ProdutoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        #$this->app->bind(\CodeEduUser\Repositories\UserRepository::class, \CodeEduUser\Repositories\UserRepositoryEloquent::class);
        #$this->app->bind(\CodeEduBook\Repositories\CapituloRepository::class, \CodeEduBook\Repositories\CapituloRepositoryEloquent::class);
        $this->app->bind(CategoriaRepository::class, CategoriaStoreRepositoryEloquent::class);
        $this->app->bind(ProdutoRepository::class, ProdutoStoreRepositoryEloquent::class);
    }
}
