<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'nm_usuario' => 'required',
            'senha' => 'required|min:6',
            'fl_permissao' => 'required',
        ];
    }

    public function messages(): array {

        return [
            'nm_usuario.required' => "Campo nome é obrigatório!",
            'senha.required' => "Campo senha é obrigatório!",
            'senha.min' => "Senha com no mínimo :min caracteres!",
            'fl_permissao.required' => "Campo permissão é obrigatório!",
        ];


    }
}
