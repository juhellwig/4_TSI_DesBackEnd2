<?php

namespace App\Http\Resources\Usuarios;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioUpdatedResource extends JsonResource
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
            'nomeusuario' => $this->nomeusuario,
            'email' => $this->email,
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
