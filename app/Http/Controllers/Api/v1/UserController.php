<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Services\UserUploadService;
use App\Http\Requests\Usuarios\UserStoreRequest;
use App\Http\Requests\Usuarios\UserUpdateRequest;
use App\Http\Resources\Usuarios\UserStoredResource;
use App\Http\Resources\Usuarios\UserUpdatedResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends ApiController
{
    public function index(Request $request)
    {
        return new UserCollection(User::all());
    }

    public function store(UserStoreRequest $request){
        try{
            $data = $request->validated();

            // Upload da imagem (se enviada)
            if ($request->hasFile('imagem')) {
                $upload = UserUploadService::handleUploadFile(
                    $request->file('imagem')
                );

                $data['imagem'] = $upload['url'];
                $data['public_id'] = $upload['public_id'];
            }

                if (isset($data['password'])) {
                    $data['password'] = Hash::make($data['password']);
                }

                $data['datacadastro'] = $data['datacadastro'] ?? now();

                return new UserStoredResource(User::create($data));
        } catch (Exception $error){
            return $this->errorHandler("Erro ao criar novo usuario!", $error, 500);
        }
    }

    public function show(Request $request, User $user)
    {
        //$usuarioLogado = $request->user();
        
        // if ($usuarioLogado->id !== $user->id && !$usuarioLogado->tokenCan('is-admin')) {
        //      return response()->json(['message' => 'Você não tem permissão para visualizar este perfil.'], 403);
        // }
        
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user){
        try {
            $data = $request->validated();

            if ($request->hasFile('imagem')) {

                // Remove imagem antiga no Cloudinary
                if ($user->public_id) {
                    Storage::delete($user->public_id);
                }

                // Upload da nova imagem
                $upload = UserUploadService::handleUploadFile(
                    $request->file('imagem')
                );

                // Salva no banco
                $data['imagem'] = $upload['url'];
                $data['public_id'] = $upload['public_id'];
            }

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);

            return new UserUpdatedResource($user);

        } catch (Exception $error) {
            return $this->errorHandler("Erro ao atualizar usuário!", $error, 500);
        }
    }

    public function destroy(Request $request, User $user){
        try {
            $usuarioLogado = $request->user();

            if ($usuarioLogado->id !== $user->id && !$usuarioLogado->tokenCan('is-admin')) {
                return response()->json(['message' => 'Sem permissão.'], 403);
            }

            // Apaga imagem do Cloudinary
            if ($user->public_id) {
                Storage::delete($user->public_id);
            }

            $user->delete();

            return response()->json(['message' => 'Usuário excluído com sucesso!'], 200);

        } catch (Exception $error) {
            return $this->errorHandler("Erro ao excluir usuário!", $error, 500);
        }
    }
}