<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        //      return response()->json(['message' => 'Você não tem permissão para visualizar este perfil.'], 403);
        // }
        
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            // A lógica de autorização foi movida para o UserUpdateRequest,
            // garantindo que o Request só seja executado se o usuário tiver permissão.
            // As linhas de checagem de permissão que estavam aqui foram removidas.

            $data = $request->validated();

            // 1. Tratamento da Imagem
            if ($request->hasFile('imagem')) {
                
                if ($user->imagem) {
                    $caminhoAnterior = str_replace(Storage::url('/'), '', $user->imagem);
                    
                    if (Storage::disk('public')->exists($caminhoAnterior)) {
                        Storage::disk('public')->delete($caminhoAnterior);
                    }
                }

                $caminhoDoArquivo = $request->file('imagem')->store('uploads/users', 'public');
                
                $data['imagem'] = Storage::url($caminhoDoArquivo);
            }
            
            // 2. Hash da Senha
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']); 
            }
            
            // 3. Executa o Update
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

             if ($user->imagem) {
                // Converte a URL pública para o caminho interno de armazenamento
                $caminhoImagem = str_replace(Storage::url('/'), '', $user->imagem);
                
                // Verifica se o arquivo existe e o deleta
                if (Storage::disk('public')->exists($caminhoImagem)) {
                    Storage::disk('public')->delete($caminhoImagem);
                }
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