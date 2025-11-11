<?php

namespace App\Http\Resources;

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
