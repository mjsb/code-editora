<?php

namespace App\Http\Requests;

use CodeEduBook\Repositories\LivroRepository;
use Illuminate\Foundation\Http\FormRequest;

class LivrosRequest extends FormRequest
{
    /**
     * @var LivroRepository
     */
    private $repository;

    /**
     * LivrosRequest constructor.
     */
    public function __construct(LivroRepository $repository)
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('livro');
        return [
            'title' => "required | max:250 | unique:livros,title,$id",
            'subtitle' => "required | max:250",
            'price' => 'required |numeric'
        ];
    }
}
