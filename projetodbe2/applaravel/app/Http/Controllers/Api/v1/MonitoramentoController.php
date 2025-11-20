<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\MonitoramentoCollection;
use App\Http\Requests\Monitoramentos\MonitoramentoStoreRequest;
use App\Http\Requests\Monitoramentos\MonitoramentoUpdateRequest;
use App\Http\Resources\Monitoramentos\MonitoramentoStoredResource;
use App\Http\Resources\Monitoramentos\MonitoramentoUpdatedResource;
use App\Http\Resources\MonitoramentoResource;
use App\Models\Monitoramento;
use Exception;

class MonitoramentoController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new MonitoramentoCollection(Monitoramento::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MonitoramentoStoreRequest $request)
    {
        try {
            $monitoramento = Monitoramento::create($request->validated());
            return new MonitoramentoStoredResource($monitoramento);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao criar monitoramento", $error, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Monitoramento $monitoramento)
    {
        return new MonitoramentoResource($monitoramento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MonitoramentoUpdateRequest $request, Monitoramento $monitoramento)
    {
        try {
            $monitoramento->update($request->validated());
            return new MonitoramentoUpdatedResource($monitoramento);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao atualizar monitoramento", $error, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monitoramento $monitoramento)
    {
        try {
            $monitoramento->delete();
            return response()->json(['message' => 'Monitoramento excluído com sucesso!'], 200);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao excluir monitoramento!", $error, 500);
        }
    }
}
