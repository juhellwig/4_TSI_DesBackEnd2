<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $usuarioLogado = $this->user();
        // O Model User injetado na rota é acessado via route('user')
        $userSendoEditado = $this->route('user'); 

        // Se a rota não injetar o usuário ou se não houver usuário logado, nega.
        if (!$usuarioLogado || !$userSendoEditado) {
            return false;
        }

        $ehDono = $usuarioLogado->id === $userSendoEditado->id;
        // Verifica se o token tem a habilidade 'is-admin'
        $ehAdmin = $usuarioLogado->tokenCan('is-admin') ?? false; 

        // Permite se for o próprio ou se for administrador
        return $ehDono || $ehAdmin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Obtém o ID do usuário da rota para ignorar na checagem de exclusividade
        $userModel = $this->route('user');
        $id = $userModel ? $userModel->id : null;
        
        // Regras para determinar se 'tipo_usuario' pode ser modificado
        $isAdmin = $this->user()->tokenCan('is-admin');

        return [
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($id)],
            'password' => 'sometimes|string|min:6',
            
            // Permite que apenas Admin altere o tipo de usuário
            'tipo_usuario' => [
                'sometimes',
                'string',
                $isAdmin 
                    ? Rule::in(['administrador', 'paciente', 'profissional'])
                    : 'prohibited' // Proíbe alteração se não for Admin
            ],
            
            // Regra de upload de imagem
            'imagem' => 'sometimes|file|image|mimes:jpg,jpeg,png,gif|max:2048', 
        ];
    }
}
