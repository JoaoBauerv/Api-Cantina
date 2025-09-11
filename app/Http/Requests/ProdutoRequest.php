<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'erros' => $validator -> errors(),
        ], 422));
    }

    
    public function rules(): array
    {
        $produtoId = $this->route('produto');

        return [
            'nm_produto' => 'required',
            'id_medida' => 'required',
        ];
    }

    public function messages(): array {

        return [
            'nm_produto.required' => "Campo nome é obrigatório!",
            'id_medida.required' => "Campo medida é obrigatório!",
        ];


    }
}
