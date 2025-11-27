<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\EnderecoCollection;
use App\Http\Resources\Enderecos\EnderecoStoredResource;
use App\Http\Requests\Enderecos\EnderecoStoreRequest;
use App\Http\Requests\Enderecos\EnderecoUpdateRequest;
use App\Http\Resources\Enderecos\EnderecoUpdatedResource;
use App\Http\Resources\EnderecoResource;
use App\Models\Endereco;
use Exception;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class EnderecoController extends ApiController
{
    public function index()
    {
        return new EnderecoCollection(Endereco::all());
    }

    public function store(EnderecoStoreRequest $request)
    {
        try {
            $data = $request->validated();
            
            $data['user_id'] = Auth::id(); 
            
            $endereco = Endereco::create($data);
            return new EnderecoStoredResource($endereco);
            
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao criar novo endereço!", $error, 500);
        }
    }

    public function show(Request $request, Endereco $endereco)
    {
        $usuarioLogado = $request->user();
        
        // $ehDono = $usuarioLogado->id === $endereco->user_id;
        // $ehAdminOuPro = $usuarioLogado->tokenCan('is-admin') || $usuarioLogado->tokenCan('is-pro');

        // if (!$ehDono && !$ehAdminOuPro) {
        //     return response()->json(['message' => 'Você não tem permissão para visualizar este endereço.'], 403);
        // }

        return new EnderecoResource($endereco);
    }

    public function update(EnderecoUpdateRequest $request, Endereco $endereco)
    {
        try {
            $usuarioLogado = $request->user();
            
            $ehDono = $usuarioLogado->id === $endereco->user_id;
            $ehAdminOuPro = $usuarioLogado->tokenCan('is-admin') || $usuarioLogado->tokenCan('is-pro');

            if (!$ehDono && !$ehAdminOuPro) {
                return response()->json(['message' => 'Você só pode editar seus próprios endereços.'], 403);
            }
            
            $endereco->update($request->validated());
            return new EnderecoUpdatedResource($endereco);
            
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao atualizar endereço!", $error, 500);
        }
    }

    public function destroy(Request $request, Endereco $endereco)
    {
        try {
            $usuarioLogado = $request->user();
            
            $ehDono = $usuarioLogado->id === $endereco->user_id;
            $ehAdminOuPro = $usuarioLogado->tokenCan('is-admin') || $usuarioLogado->tokenCan('is-pro');

            if (!$ehDono && !$ehAdminOuPro) {
                return response()->json(['message' => 'Você só pode excluir seus próprios endereços.'], 403);
            }
            
            $endereco->delete();
            return response()->json(['message' => 'Endereço removido com sucesso!'], 200);
            
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao excluir endereço!", $error, 500);
        }
    }
}