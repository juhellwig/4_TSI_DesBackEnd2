<?php

namespace App\Http\Resources\Usuarios;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStoredResource extends JsonResource
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
            'name' => $this->name,
            'dtnasc'=> $this->dtnasc, 
            'sexo'=> $this->sexo, 
            'cpf' => $this->cpf, 
            'telefone'=> $this->telefone, 
            'tipo_usuario' => $this->tipo_usuario,
            'imagem' => $this->imagem,
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
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
