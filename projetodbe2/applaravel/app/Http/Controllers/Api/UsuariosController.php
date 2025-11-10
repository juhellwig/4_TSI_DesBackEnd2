<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UsuarioCollection;
use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuariosController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UsuarioCollection(Usuario::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return new UsuarioResource($usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
