<?php

namespace App\Http\Requests\Usuarios;

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
            "nomeusuario"   => "required|max:50",
            "dtnasc"        => "required|date",
            "sexo"          => "required|max:1",
            "cpf"           => "required|max:11|unique:usuarios,cpf",
            "telefone"      => "nullable|max:15",
            "email"         => "required|email|unique:usuarios,email",
            "tipo_usuario"  => "required|string",
            "password"      => "required|min:5",
            "datacadastro"  => "nullable|date",
            "imagem"        => "nullable|string"
        ];
    }

    public function messages()
    {
        return [
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.unique' => 'Este e-mail já está em uso.',
        ];
    }

}
