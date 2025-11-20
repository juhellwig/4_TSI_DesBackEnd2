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

class EnderecoController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EnderecoCollection(Endereco::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnderecoStoreRequest $request)
    {
        try {
            $endereco = Endereco::create($request->validated());
            return new EnderecoStoredResource($endereco);
        } catch (\Exception $error) {
            return $this->errorHandler("Erro ao criar novo endereço!", $error, 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Endereco $endereco)
    {
        return new EnderecoResource($endereco);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnderecoUpdateRequest $request, Endereco $endereco)
    {
         try {
            $endereco->update($request->validated());
            return new EnderecoUpdatedResource($endereco);
        } catch (\Exception $e) {
            return $this->errorHandler("Erro ao atualizar endereço!", $error, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Endereco $endereco)
    {
        try {
            $endereco->delete();
            return response()->json([
                'message' => 'Endereço removido com sucesso!'
            ], 200);
        } catch (\Exception $e) {
            return $this->errorHandler("Erro ao excluir endereço!", $error, 500);

        }
    }
}
