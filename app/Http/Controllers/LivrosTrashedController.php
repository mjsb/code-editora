<?php

namespace App\Http\Controllers;

use App\Repositories\LivrosRepository;
use Illuminate\Http\Request;

class LivrosTrashedController extends Controller
{
    /**
     * @var LivrosRepository
     */
    private $repository;

    public function __construct(LivrosRepository $repository)
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
        $this->repository->onlyTrashed();
        $livros = $this->repository->paginate(10);
        return view('trashed.livros.index', compact('livros', 'search'));

    }

    public function show($id) {

        $this->repository->onlyTrashed();
        $livro = $this->repository->find($id);
        return view('trashed.livros.show', compact('livro'));

    }

    public function update(Request $request, $id) {

        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $url = $request->get('redirect_to', route('trashed.livros.index'));
        $request->session()->flash('message', 'Livro restaurado com sucesso!');
        return redirect()->to($url);

    }
}
