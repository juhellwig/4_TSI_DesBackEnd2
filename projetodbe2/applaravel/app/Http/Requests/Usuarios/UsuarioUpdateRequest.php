<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioUpdateRequest extends FormRequest
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
        $id = $this->usuario->id ?? null;

        return [
            'nomeusuario' => 'sometimes|string|max:255',
            'email' => "sometimes|email|unique:usuarios,email,$id",
            'password' => 'sometimes|string|min:6',
    ];
    }
}
