<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStoreRequest extends FormRequest
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
            "nomeusuario" => "required|max: 50",
            "dtnasc" => "required",
            "sexo" => "required|max: 1",
            "cpf" => "required|max: 11",
            "telefone" => "max: 15",
            "email" => "unique:usuarios",
            "tipo_usuario" => "required",
            "password" => "required|min: 5",
            "imagem" => "nullable|string"
        ];
    }
}
