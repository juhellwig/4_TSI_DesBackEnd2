<?php

use App\Http\Controllers\Web\EnderecosController;
use App\Http\Controllers\Web\MonitoramentosController;
use App\Http\Controllers\Web\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', [UsuariosController::class, 'listarUsuarios'])->name('usuarios.lista');
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/edit/{id}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
Route::post('/usuarios/update/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/delete/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.delete');

Route::get('/enderecos', [EnderecosController::class, 'listarEnderecos'])->name('enderecos.lista');
Route::post('/enderecos', [EnderecosController::class, 'store'])->name('enderecos.store');
Route::get('/enderecos/create', [EnderecosController::class, 'create'])->name('enderecos.create');
Route::get('/enderecos/{id}/edit', [EnderecosController::class, 'edit'])->name('enderecos.edit');
Route::put('/enderecos/{id}', [EnderecosController::class, 'update'])->name('enderecos.update');
Route::delete('/enderecos/{id}', [EnderecosController::class, 'destroy'])->name('enderecos.destroy');

Route::get('/monitoramentos', [MonitoramentosController::class, 'listarMonitoramentos'])->name('monitoramentos.lista');
Route::get('/monitoramentos/create', [MonitoramentosController::class, 'create'])->name('monitoramentos.create');
Route::post('/monitoramentos', [MonitoramentosController::class, 'store'])->name('monitoramentos.store');
Route::get('/monitoramentos/{id}/edit', [MonitoramentosController::class, 'edit'])->name('monitoramentos.edit');
Route::put('/monitoramentos/{id}', [MonitoramentosController::class, 'update'])->name('monitoramentos.update');
Route::delete('/monitoramentos/{id}', [MonitoramentosController::class, 'destroy'])->name('monitoramentos.destroy');
