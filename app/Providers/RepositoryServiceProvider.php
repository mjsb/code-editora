<?php

namespace App\Providers;

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
        $this->app->bind(\App\Repositories\CategoriasRepository::class, \App\Repositories\CategoriasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LivrosRepository::class, \App\Repositories\LivrosRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UsersRepository::class, \App\Repositories\UsersRepositoryEloquent::class);
        //:end-bindings:
    }
}
