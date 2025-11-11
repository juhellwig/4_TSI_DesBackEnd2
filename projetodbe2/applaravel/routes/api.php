<?php

use App\Http\Controllers\Api\EnderecosController;
use App\Http\Controllers\Api\MonitoramentosController;
use App\Http\Controllers\Api\UsuariosController;
use App\Models\Enderecos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResources([
    'usuarios' => UsuariosController::class,
    'enderecos' => EnderecosController::class,
    'monitoramentos' => MonitoramentosController::class,
]);