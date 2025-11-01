<?php

namespace App\Http\Controllers;

use App\Models\Usuario;

class UsuariosController
{
    public function listarUsuarios()
    {
        $listUsuarios = Usuario::all();
        return view('usuarios', compact('listUsuarios'));
    }
}
