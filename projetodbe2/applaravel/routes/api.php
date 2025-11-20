<?php

use App\Http\Controllers\Api\v1\Auth\LoginTokensController;
use App\Http\Controllers\Api\v1\EnderecoController;
use App\Http\Controllers\Api\v1\MonitoramentoController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResources([
    'users' => UserController::class,
    'enderecos' => EnderecoController::class,
    'monitoramentos' => MonitoramentoController::class,
]);

    Route::prefix('tokens')
    ->controller(LoginTokensController::class)
    ->group(function(){
        Route::post('logout', 'logout')->middleware("auth:sanctum");
        Route::post('login', 'login');
    });
});