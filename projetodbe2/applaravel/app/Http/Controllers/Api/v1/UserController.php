<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Usuarios\UserStoreRequest;
use App\Http\Requests\Usuarios\UserUpdateRequest;
use App\Http\Resources\Usuarios\UserStoredResource;
use App\Http\Resources\Usuarios\UserUpdatedResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
{
    public function index(Request $request)
    {
        return new UserCollection(User::all());
    }

    public function store(UserStoreRequest $request)
    {
        try{
            $data = $request->validated();
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            return new UserStoredResource(User::create($data));
        } catch (Exception $error){
            return $this->errorHandler("Erro ao criar novo usuario!", $error, 500);
        }
    }

    public function show(Request $request, User $user)
    {
        $usuarioLogado = $request->user();
        
        // if ($usuarioLogado->id !== $user->id && !$usuarioLogado->tokenCan('is-admin')) {
        //      return response()->json(['message' => 'Você não tem permissão para visualizar este perfil.'], 403);
        // }
        
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $ehOProprioUsuario = $request->user()->id === $user->id;
            $ehAdmin = $request->user()->tokenCan('is-admin');

            if (!$ehOProprioUsuario && !$ehAdmin) {
                return response()->json(['message' => 'Você não tem permissão para editar outro usuário.'], 403);
            }

            $data = $request->validated();
            
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']); 
            }
            
            $user->update($data);

            return new UserUpdatedResource($user);
            
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao atualizar usuário!", $error, 500);
        }
    }

    public function destroy(Request $request, User $user)
    {
        try {
            $usuarioLogado = $request->user(); 
            
            if ($usuarioLogado->id !== $user->id && !$usuarioLogado->tokenCan('is-admin')) {
                return response()->json(['message' => 'Você não pode excluir outros usuários.'], 403);
            }

            $user->delete();

            return response()->json([
                'message' => 'Usuário excluído com sucesso!'
            ], 200);
            
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao excluir usuário!", $error, 500);
        }
    }
}