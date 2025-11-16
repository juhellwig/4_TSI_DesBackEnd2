<?php

namespace App\Http\Requests\Enderecos;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cep' => 'sometimes|required|size:8',
            'logradouro' => 'sometimes|required|max:100',
            'numero' => 'sometimes|required|integer',
            'complemento' => 'nullable|max:50',
            'bairro' => 'sometimes|required|max:50',
            'cidade' => 'sometimes|required|max:50',
            'estado' => 'sometimes|required|size:2',
            'pais' => 'sometimes|required|max:30',
        ];
    }
}
