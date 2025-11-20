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

class UserController extends ApiController
{
    public function index()
    {
        return new UserCollection(User::all());
    }

    public function store(UserStoreRequest $request)
    {
        try{
            return new UserStoredResource(User::create($request->validated()));
        } catch (Exception $error){
            return $this->errorHandler("Erro ao criar novo usuario!", $error, 500);
        }
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        try {
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return new UserUpdatedResource($user);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao atualizar usuário!", $error, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
        $user->delete();

        return response()->json([
            'message' => 'Usuário excluído com sucesso!'
        ], 200);
    } catch (Exception $error) {
        return $this->errorHandler("Erro ao excluir usuário!", $error, 500);
    }
    }
}