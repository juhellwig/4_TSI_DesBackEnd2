<?php

namespace App\Http\Resources\Monitoramentos;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

class MonitoramentoStoredResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'paciente_id'         => $this->paciente_id,
            'profissional_id'     => $this->profissional_id,
            'dt_monitoramento'  => $this->dt_monitoramento,
            'hora_monitoramento'=> $this->hora_monitoramento,
            'tipo'              => $this->tipo,
            'observacoes'       => $this->observacoes,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setStatusCode(201, 'Monitoramento Criado!');
    }

    public function with(Request $request): array
    {
        return [
            'message' => 'Monitoramento criado com sucesso!'
        ];
    }
}