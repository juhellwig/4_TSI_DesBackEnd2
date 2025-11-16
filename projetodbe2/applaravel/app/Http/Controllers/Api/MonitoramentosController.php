<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MonitoramentosCollection;
use App\Http\Requests\Monitoramentos\MonitoramentoStoreRequest;
use App\Http\Requests\Monitoramentos\MonitoramentoUpdateRequest;
use App\Http\Resources\Monitoramentos\MonitoramentoStoredResource;
use App\Http\Resources\Monitoramentos\MonitoramentoUpdatedResource;
use App\Http\Resources\MonitoramentosResource;
use App\Models\Monitoramentos;
use Exception;

class MonitoramentosController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new MonitoramentosCollection(Monitoramentos::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MonitoramentoStoreRequest $request)
    {
        try {
            $monitoramento = Monitoramentos::create($request->validated());
            return new MonitoramentoStoredResource($monitoramento);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao criar monitoramento", $error, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Monitoramentos $monitoramento)
    {
        return new MonitoramentosResource($monitoramento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MonitoramentoUpdateRequest $request, Monitoramentos $monitoramento)
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
    public function destroy(Monitoramentos $monitoramento)
    {
        try {
            $monitoramento->delete();
            return response()->json(['message' => 'Monitoramento excluído com sucesso!'], 200);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao excluir monitoramento!", $error, 500);
        }
    }
}
