<?php

namespace App\Http\Requests;

use App\Repositories\LivrosRepository;

class LivrosUpdateRequest extends LivrosCreateRequest
{
    /**
     * @var LivrosRepository
     */
    private $repository;

    /**
     * LivrosRequest constructor.
     */
    public function __construct(LivrosRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = (int) $this->route('livro');
        if($id == 0) {
            return false;
        }

        $livro = $this->repository->find($id);

        return $livro->author_id == \Auth::user()->id;
    }

}