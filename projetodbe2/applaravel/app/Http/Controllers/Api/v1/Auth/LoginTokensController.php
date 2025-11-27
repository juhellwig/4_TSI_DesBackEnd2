<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Exception;

class LoginTokensController extends LoginController
{
    public function login (LoginRequest $request){
    try{
        $user = $this->authenticate($request->validated());
        if(!$user) throw new Exception("Dados inválidos!");

        $abilities = [];
        
        if ($user->tipo_usuario === 'administrador') {
            $abilities = ['is-admin'];
        } 
        elseif ($user->tipo_usuario === 'profissional') {
            $abilities = ['is-pro'];
        } 
        else {
            $abilities = ['is-customer'];
        }

        $token = $user->createToken($user->email, $abilities)->plainTextToken;

        return compact('token', 'user');
    }catch(Exception $error){
        return $this->errorHandler($error->getMessage(), $error, 401);
    }
}

    public function logout(Request $request)
{
    if ($request->boolean('revoke_all')) {
        
        $request->user()->tokens()->delete();
        $mensagem = 'Desconectado de todos os dispositivos.';
        
    } else {
        $request->user()->currentAccessToken()->delete();
        $mensagem = 'Logout realizado com sucesso.';
    }

    return response()->json([
        'message' => $mensagem
    ], 200);
}
}
