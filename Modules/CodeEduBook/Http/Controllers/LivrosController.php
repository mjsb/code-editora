<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Criteria\FindByAuthor;
use CodeEduBook\Http\Requests\LivrosCreateRequest;
use CodeEduBook\Http\Requests\LivrosUpdateRequest;
use CodeEduBook\Repositories\CategoriasRepository;
use CodeEduBook\Repositories\LivrosRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="book-admin", description="Administração de livros")
 */
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
        $this->repository->pushCriteria(new FindByAuthor());
        $this->categoriasRepository = $categoriasRepository;
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="Listar livros")
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $search = $request->get('search');
        $livros = $this->repository->paginate(10);
        return view('codeedubook::livros.index', compact('livros', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Cadastrar livros")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = $this->categoriasRepository->lists('name','id');
        return view('codeedubook::livros.create', compact('categorias'));

    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Cadastrar livros")
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
     * @Permission\Action(name="update", description="Atualizar livros")
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livro = $this->repository->find($id);
        $categorias = $this->categoriasRepository->lists('name','id');
        return view('codeedubook::livros.edit', compact('livro','categorias'));

    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar livros")
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
     * @Permission\Action(name="delete", description="Excluir livros")
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
