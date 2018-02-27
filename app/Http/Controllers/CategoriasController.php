<?php

namespace App\Http\Controllers;

use App\Criteria\FindByNameCriteria;
use App\Models\Categoria;
use App\Http\Requests\CategoriasRequest;
use App\Repositories\CategoriasRepository;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{

    /**
     * @var CategoriasRepository
     */
    private $repository;

    /**
     * CategoriasController constructor.
     * @param CategoriasRepository $repository
     */

    public function __construct(CategoriasRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $search = $request->get('search');
        $this->repository->pushCriteria(new FindByNameCriteria($search));
        $categorias = $this->repository->paginate(10);
        return view('categorias.index', compact('categorias', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriasRequest $request)
    {

        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('categorias.index'));
        $request->session()->flash('message', 'Categoria cadastrada com sucesso!');
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
        $categoria = $this->repository->find($id);
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoriasRequest|Request $request
     * @param Categoria $categoria
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(CategoriasRequest $request, $id)
    {

        $this->repository->update($request->all(),$id);
        $url = $request->get('redirect_to', route('categorias.index'));
        $request->session()->flash('message', 'Categoria alterada com sucesso!');
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
        \Session::flash('message', 'Categoria excluida com sucesso!');
        return redirect()->to(\URL::previous());
    }
}
