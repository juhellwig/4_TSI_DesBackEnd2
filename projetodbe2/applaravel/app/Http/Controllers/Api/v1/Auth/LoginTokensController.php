<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Requests\LoginRequest;
use Exception;

class LoginTokensController extends LoginController
{
    public function login (LoginRequest $request){
        try{
            $user = $this->authenticate($request->validated());
            if(!$user) throw new Exception("Dados inválidos!");
            $token = $user->createToken($user->email)->plainTextToken;
            return compact('token', 'user');
        }catch(Exception $error){
            return $this->errorHandler($error->getMessage(), $error, 401);
        }
    }
}
