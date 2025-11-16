<?php

namespace App\Http\Requests\Enderecos;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoStoreRequest extends FormRequest
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
            'cep' => 'required|digits:8',
            'logradouro' => 'required|max:100',
            'numero' => 'required|integer',
            'complemento' => 'nullable|max:50',
            'bairro' => 'required|max:50',
            'cidade' => 'required|max:50',
            'estado' => 'required|size:2',
            'pais' => 'required|max:30',
        ];
    }
}
