<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Resources\UsuarioCollection;
use App\Http\Resources\UsuarioStoredResource;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;

class UsuariosController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UsuarioCollection(Usuario::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioStoreRequest $request)
    {
        try{
            return new UsuarioStoredResource(Usuario::create($request->validated()));
        } catch (Exception $error){
            return $this->errorHandler("Erro ao criar novo usuario!", $error, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return new UsuarioStoredResource($usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
