<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Api\v1\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends UserController
{
    public function authenticate(array $credentials) : User | null{
        if(Auth::attempt($credentials))
            return User::where('email', $credentials['email'])->first();
        return null;
    }
}
