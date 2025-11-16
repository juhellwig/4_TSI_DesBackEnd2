<?php

namespace App\Http\Resources\Usuarios;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioStoredResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'nomeusuario' => $this->nomeusuario,
            'email' => $this->email,
            'created_at' => $this->created_at,
        ];
    }

    public function withResponse(Request $request, JsonResponse $response) :void
    {
        $response->setStatusCode(201, 'Usuario Criado!');
    }
    
    public function with(Request $request): array{
        return [
            'message' => 'Usuario criado com sucesso!',
        ];
    }
}
