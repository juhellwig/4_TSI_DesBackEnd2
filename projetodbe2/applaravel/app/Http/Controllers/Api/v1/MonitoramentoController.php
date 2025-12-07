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
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MonitoramentoController extends ApiController
{
    public function index()
    {
        return new MonitoramentoCollection(Monitoramento::all());
    }
    
    public function store(MonitoramentoStoreRequest $request)
    {
        try {
            $data = $request->validated(); 
            
            $user = $request->user();

            if ($user && $user->tipo_usuario === 'profissional') {
                $data['profissional_id'] = $user->id; 
            } 
            // Se for 'admin' ou outro tipo (como 'paciente', se tiver permissão), 
            // o campo 'profissional_id' NÃO é adicionado a $data. 
            // Como o campo é nullable no banco de dados e não é required no Request,
            // ele será inserido como NULL, atendendo a regra.
            
            $monitoramento = Monitoramento::create($data); 

            return new MonitoramentoStoredResource($monitoramento);

        } catch (Exception $error) {    
            return $this->errorHandler("Erro ao criar monitoramento", $error, 500); 
        }
    }

    public function show(Request $request, Monitoramento $monitoramento)
    {
        $usuarioLogado = $request->user();
        
        // if (
        //     $usuarioLogado->id !== $monitoramento->user_id && 
        //     !$usuarioLogado->tokenCan('is-admin') 
        // ) {
        //     return response()->json(['message' => 'Você não tem permissão para visualizar este monitoramento.'], 403);
        // }

        return new MonitoramentoResource($monitoramento);
    }

    public function update(MonitoramentoUpdateRequest $request, Monitoramento $monitoramento)
    {
        try {
            $usuarioLogado = $request->user();
            
            $ehDono = $usuarioLogado->id === $monitoramento->user_id;
            $ehAdmin = $usuarioLogado->tokenCan('is-admin');

            if (!$ehDono && !$ehAdmin) {
                return response()->json(['message' => 'Você só pode editar seus próprios monitoramentos.'], 403);
            }
            
            $monitoramento->update($request->validated());
            return new MonitoramentoUpdatedResource($monitoramento);

        } catch (Exception $error) {
            return $this->errorHandler("Erro ao atualizar monitoramento", $error, 500);
        }
    }

    public function destroy(Request $request, Monitoramento $monitoramento)
    {
        try {
            $usuarioLogado = $request->user();
            
            $ehDono = $usuarioLogado->id === $monitoramento->user_id;
            $ehAdmin = $usuarioLogado->tokenCan('is-admin');

            if (!$ehDono && !$ehAdmin) {
                return response()->json(['message' => 'Você só pode excluir seus próprios monitoramentos.'], 403);
            }
            
            $monitoramento->delete();
            return response()->json(['message' => 'Monitoramento excluído com sucesso!'], 200);

        } catch (Exception $error) {
            return $this->errorHandler("Erro ao excluir monitoramento!", $error, 500);
        }
    }
}