<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UsersRequest;
use CodeEduUser\Repositories\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * @var UsersRepository
     */
    private $repository;

    /**
     * UsersController constructor.
     * @param UsersRepository $repository
     */

    public function __construct(UsersRepository $repository)
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
        #$this->repository->pushCriteria(new FindByNameCriteria($search));
        $users = $this->repository->paginate(10);
        return view('codeeduuser::users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário cadastrado com sucesso!');
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
        $user = $this->repository->find($id);
        return view('codeeduuser::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UsersRequest|Request $request
     * @param \CodeEduUser\Models\Usuário $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(UsersRequest $request, $id)
    {
        $this->repository->update($request->all(),$id);
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário alterado com sucesso!');
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
        \Session::flash('message', 'Usuário excluido com sucesso!');
        return redirect()->to(\URL::previous());
    }
}
