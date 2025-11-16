<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Usuarios\UsuarioStoreRequest;
use App\Http\Resources\UsuarioCollection;
use App\Http\Resources\Usuarios\UsuarioStoredResource;
use App\Http\Resources\Usuarios\UsuarioUpdatedResource;
use App\Http\Requests\Usuarios\UsuarioUpdateRequest;
use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;
use Exception;

class UsuariosController extends ApiController
{
    public function index()
    {
        return new UsuarioCollection(Usuario::all());
    }

    public function store(UsuarioStoreRequest $request)
    {
        try{
            return new UsuarioStoredResource(Usuario::create($request->validated()));
        } catch (Exception $error){
            return $this->errorHandler("Erro ao criar novo usuario!", $error, 500);
        }
    }

    public function show(Usuario $usuario)
    {
        return new UsuarioResource($usuario);
    }

    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {
        try {
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $usuario->update($data);

        return new UsuarioUpdatedResource($usuario);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao atualizar usuário!", $error, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        try {
        $usuario->delete();

        return response()->json([
            'message' => 'Usuário excluído com sucesso!'
        ], 200);
    } catch (Exception $error) {
        return $this->errorHandler("Erro ao excluir usuário!", $error, 500);
    }
    }
}
