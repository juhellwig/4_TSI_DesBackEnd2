<?php

namespace App\Http\Resources\Monitoramentos;

use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class MonitoramentoUpdatedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id'                 => $this->id,
            'dt_monitoramento'   => $this->dt_monitoramento,
            'hora_monitoramento' => $this->hora_monitoramento,
            'tipo'               => $this->tipo,
            'observacoes'        => $this->observacoes,
            'updated_at'         => $this->updated_at,
        ];
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setStatusCode(200, 'Monitoramento Atualizado!');
    }

    public function with(Request $request): array
    {
        return [
            'message' => 'Monitoramento atualizado com sucesso!',
        ];
    }
}