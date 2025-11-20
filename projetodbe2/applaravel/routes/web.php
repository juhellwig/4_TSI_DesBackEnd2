<?php

use App\Http\Controllers\Web\EnderecoController;
use App\Http\Controllers\Web\MonitoramentoController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', [UserController::class, 'listarUsuarios'])->name('usuarios.lista');
Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/store', [UserController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/edit/{id}', [UserController::class, 'edit'])->name('usuarios.edit');
Route::post('/usuarios/update/{id}', [UserController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/delete/{id}', [UserController::class, 'destroy'])->name('usuarios.delete');

Route::get('/enderecos', [EnderecoController::class, 'listarEnderecos'])->name('enderecos.lista');
Route::get('/enderecos/create', [EnderecoController::class, 'create'])->name('enderecos.create');
Route::post('/enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');
Route::get('/enderecos/{id}/edit', [EnderecoController::class, 'edit'])->name('enderecos.edit');
Route::put('/enderecos/{id}', [EnderecoController::class, 'update'])->name('enderecos.update');
Route::delete('/enderecos/{id}', [EnderecoController::class, 'destroy'])->name('enderecos.destroy');

Route::get('/monitoramentos', [MonitoramentoController::class, 'listarMonitoramentos'])->name('monitoramentos.lista');
Route::get('/monitoramentos/create', [MonitoramentoController::class, 'create'])->name('monitoramentos.create');
Route::post('/monitoramentos', [MonitoramentoController::class, 'store'])->name('monitoramentos.store');
Route::get('/monitoramentos/{id}/edit', [MonitoramentoController::class, 'edit'])->name('monitoramentos.edit');
Route::put('/monitoramentos/{id}', [MonitoramentoController::class, 'update'])->name('monitoramentos.update');
Route::delete('/monitoramentos/{id}', [MonitoramentoController::class, 'destroy'])->name('monitoramentos.destroy');
