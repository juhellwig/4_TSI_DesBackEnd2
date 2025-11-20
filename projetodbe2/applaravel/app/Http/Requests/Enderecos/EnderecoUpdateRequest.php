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
            "cep"         => "required|size:8",
            "logradouro"  => "required|max:100",
            "numero"      => "required|integer",
            "complemento" => "nullable|max:50",
            "bairro"      => "required|max:50",
            "cidade"      => "required|max:50",
            "estado"      => "required|size:2",
            "pais"        => "required|max:30"
        ];
    }

    public function messages()
    {
        return [
            'cep.required' => 'O CEP é obrigatório.',
            'cep.size' => 'O CEP deve conter exatamente 8 dígitos.',

            'logradouro.required' => 'O logradouro é obrigatório.',
            'logradouro.max' => 'O logradouro deve ter no máximo 100 caracteres.',

            'numero.required' => 'O número é obrigatório.',
            'numero.integer' => 'O número deve ser um valor inteiro.',

            'complemento.max' => 'O complemento deve ter no máximo 50 caracteres.',

            'bairro.required' => 'O bairro é obrigatório.',
            'bairro.max' => 'O bairro deve ter no máximo 50 caracteres.',

            'cidade.required' => 'A cidade é obrigatória.',
            'cidade.max' => 'A cidade deve ter no máximo 50 caracteres.',

            'estado.required' => 'O estado é obrigatório.',
            'estado.size' => 'O estado deve ter exatamente 2 caracteres (UF).',

            'pais.required' => 'O país é obrigatório.',
            'pais.max' => 'O país deve ter no máximo 30 caracteres.',
        ];
    }
}