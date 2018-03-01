<?php

use Illuminate\Database\Seeder;
use CodeEduBook\Models\Livro;

class LivrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = \CodeEduBook\Models\Categoria::all();
        factory(Livro::class, 20)->create()->each(function($livro) use($categorias) {
            $categoriasRandom = $categorias->random(4);
            $livro->categorias()->sync($categoriasRandom->pluck('id')->all());
        });
    }
}
