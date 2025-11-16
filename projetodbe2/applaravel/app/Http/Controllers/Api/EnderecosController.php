<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EnderecosCollection;
use App\Http\Resources\Enderecos\EnderecoStoredResource;
use App\Http\Requests\Enderecos\EnderecoStoreRequest;
use App\Http\Requests\Enderecos\EnderecoUpdateRequest;
use App\Http\Resources\Enderecos\EnderecoUpdatedResource;
use App\Http\Resources\EnderecosResource;
use App\Models\Enderecos;
use Exception;

class EnderecosController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EnderecosCollection(Enderecos::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnderecoStoreRequest $request)
    {
        try {
            $endereco = Enderecos::create($request->validated());
            return new EnderecoStoredResource($endereco);
        } catch (\Exception $error) {
            return $this->errorHandler("Erro ao criar novo endereço!", $error, 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Enderecos $endereco)
    {
        return new EnderecosResource($endereco);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnderecoUpdateRequest $request, Enderecos $endereco)
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
    public function destroy(Enderecos $endereco)
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
