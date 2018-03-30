<?php

namespace CodeEduBook\Http\Requests;

use CodeEduBook\Repositories\LivrosRepository;
use CodeEduBook\Http\Requests\LivrosCreateRequest;

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
        $user = \Auth::user();

        return $user->can('update',$livro);
    }

}