<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivrosCreateRequest;
use App\Http\Requests\LivrosUpdateRequest;
use App\Repositories\CategoriasRepository;
use App\Repositories\LivrosRepository;
use Illuminate\Http\Request;

class LivrosController extends Controller
{
    /**
     * @var LivrosRepository
     */
    private $repository;
    /**
     * @var CategoriasRepository
     */
    private $categoriasRepository;

    public function __construct(LivrosRepository $repository, CategoriasRepository $categoriasRepository)
    {
        $this->repository = $repository;
        $this->categoriasRepository = $categoriasRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $search = $request->get('search');
        $livros = $this->repository->paginate(10);
        return view('livros.index', compact('livros', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = $this->categoriasRepository->lists('name','id');
        return view('livros.create', compact('categorias'));

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LivrosCreateRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = \Auth::user()->id;
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('livros.index'));
        $request->session()->flash('message', 'Livro cadastrado com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livro = $this->repository->find($id);
        $categorias = $this->categoriasRepository->lists('name','id');
        return view('livros.edit', compact('livro','categorias'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(LivrosUpdateRequest $request, $id)
    {
        $data = $request->except(['author_id']);
        $this->repository->update($data,$id);
        $url = $request->get('redirect_to', route('livros.index'));
        $request->session()->flash('message', 'Livro alterado com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Livro movido para lixeira com sucesso!');
        return redirect()->route('livros.index');
    }
}
