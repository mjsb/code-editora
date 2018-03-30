<?php

    Route::group(['middleware' => ['auth', config('codeeduuser.middleware.isVerified')]], function (){
        Route::resource('categorias','CategoriasController', ['except' => 'show']);
        Route::resource('livros','LivrosController', ['except' => 'show']);
        Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
            Route::resource('livros', 'LivrosTrashedController', ['except' => ['create', 'store', 'edit', 'destroy']]);
        });
    });