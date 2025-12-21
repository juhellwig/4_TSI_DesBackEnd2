<?php

namespace App\Http\Resources\Enderecos;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class EnderecoUpdatedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'cep'         => $this->cep,
            'logradouro'  => $this->logradouro,
            'numero'      => $this->numero,
            'complemento' => $this->complemento,
            'bairro'      => $this->bairro,
            'cidade'      => $this->cidade,
            'estado'      => $this->estado,
            'pais'        => $this->pais,
            'updated_at'  => $this->updated_at,
        ];
    }

     public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setStatusCode(200, 'Endereço atualizado com sucesso!');
    }

    public function with(Request $request): array
    {
        return [
            'message' => 'Endereço atualizado com sucesso!',
        ];
    }
}