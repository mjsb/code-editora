<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivrosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $livro = $this->route('livro');
        $id = $livro ? $livro->id:null;
        return [
            'title' => "required | max:50 | unique:livros,title,$id",
            'subtitle' => "required | max:50",
            'price' => 'required | max:7'
        ];
    }
}
