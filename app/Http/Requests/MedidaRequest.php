<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MedidaRequest extends FormRequest
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
        $medidaId = $this->route('medida');

        return [
            'nm_medida' => 'required',
        ];
    }

    public function messages(): array {

        return [
            'nm_medida.required' => "Campo nome é obrigatório!",
        ];


    }
}
