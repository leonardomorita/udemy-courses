<?php

// Estuda: OK

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            'name'          => 'required',
            'description'   => 'required|min:30',
            'body'          => 'required',
            'price'         => 'required',
            'categories'    => 'required',
            'photos.*'      => 'image' // como o photos é um array, usa '.' para acessar o índice do array e o '*' para dizer que é para verificar cada índice do array
        ];
    }

    public function messages()
    {
        return [
            'required'  => 'O campo é obrigatório.',
            'min'       => 'O campo é obrigatório ter no mínimo :min cartactéres.',
            'image'     => 'O arquivo não é uma imagem válida.'
        ];
    }
}
