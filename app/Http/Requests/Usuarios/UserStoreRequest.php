<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            "name"          => "required|max:50",
            "dtnasc"        => "required|date",
            "sexo"          => "required|max:1",
            "cpf"           => "required|max:11|unique:users,cpf",
            "telefone"      => "nullable|max:15",
            "email"         => "required|email|unique:users,email",
            "tipo_usuario" => "required|in:paciente,profissional,administrador",
            "password"      => "required|min:5",
            "datacadastro"  => "nullable|date",
            "imagem"        => "nullable|file|image|mimes:jpg,jpeg,png|max:2048"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.max' => 'O nome deve ter no máximo 50 caracteres',
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'Informe um e-mail válido',
            'email.unique' => 'Este e-mail já está em uso.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'password.required' => 'A senha é obrigatória'
        ];
    }

}
