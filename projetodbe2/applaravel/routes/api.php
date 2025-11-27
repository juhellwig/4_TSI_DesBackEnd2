<?php

use App\Http\Controllers\Api\v1\Auth\LoginTokensController;
use App\Http\Controllers\Api\v1\EnderecoController;
use App\Http\Controllers\Api\v1\MonitoramentoController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {

    Route::post('/tokens/login', [LoginTokensController::class, 'login']);

    Route::apiResource('enderecos', EnderecoController::class)->only(['index', 'show']);
    Route::apiResource('monitoramentos', MonitoramentoController::class)->only(['index', 'show']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function () {
        
        Route::post('/tokens/logout', [LoginTokensController::class, 'logout']);
        Route::get('/user', fn(Request $request) => $request->user());

        Route::middleware('abilities:is-admin,is-pro')->group(function () {
             Route::apiResource('enderecos', EnderecoController::class)->except(['index', 'show']);
        });
        
        Route::middleware('ability:is-admin')->group(function () {
             Route::post('/users', [UserController::class, 'store']);
             //Route::get('/users', [UserController::class, 'index']);
             Route::apiResource('monitoramentos', MonitoramentoController::class)->except(['index', 'show']);
        });

       // Route::get('/users/{user}', [UserController::class, 'show']);
        
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
    });
});