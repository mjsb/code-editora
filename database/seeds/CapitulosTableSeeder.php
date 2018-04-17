<?php

use CodeEduBook\Models\Livro;
use CodeEduBook\Models\Capitulo;
use Illuminate\Database\Seeder;

class CapitulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $livros = Livro::all();
        foreach ($livros as $livro){
            $capitulos = factory(Capitulo::class, 5)->make();
            foreach ($capitulos as $key => $capitulo){
                $capitulo->book_id = $livro->id;
                $capitulo->order = $key + 1;
                $capitulo->save();
            }
        }
    }
}
