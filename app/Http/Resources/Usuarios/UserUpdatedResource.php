<?php

namespace App\Http\Resources\Usuarios;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class UserUpdatedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'telefone'=> $this->telefone,
            'imagem' => $this->imagem,
            'tipo_usuario' => $this->tipo_usuario,
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setStatusCode(200, 'Usuário atualizado com sucesso!');
    }

    public function with(Request $request): array
    {
        return [
            'message' => 'Usuário atualizado com sucesso!',
        ];
    }
}
