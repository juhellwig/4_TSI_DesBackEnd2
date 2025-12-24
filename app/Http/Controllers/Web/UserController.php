<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserUploadService;
use Illuminate\Support\Facades\Storage;

class UserController{
    public function listarUsuarios()
    {
        $listUsuarios = User::all();
        return view('usuarios.usuarios', compact('listUsuarios'));
    }

    // Exibir formulário de criação
    public function create()
    {
        return view('usuarios.create');
    }

    // Salvar usuário
    public function store()
    {
        $data = request()->all();

        if (request()->hasFile('imagem')) {
            $upload = UserUploadService::handleUploadFile(
                request()->file('imagem')
            );

            $data['imagem'] = $upload['url'];
            $data['public_id'] = $upload['public_id'];
        }

        User::create($data);

        return redirect()
            ->route('usuarios.lista')
            ->with('success', 'Usuário cadastrado com sucesso!');
    }

    // Exibir formulário de edição
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Atualizar usuário
    public function update($id)
    {
        $usuario = User::findOrFail($id);
        $data = request()->all();

        if (request()->hasFile('imagem')) {

            // remove imagem antiga
            if ($usuario->public_id) {
                Storage::delete($usuario->public_id);
            }

            $upload = UserUploadService::handleUploadFile(
                request()->file('imagem')
            );

            $data['imagem'] = $upload['url'];
            $data['public_id'] = $upload['public_id'];
        }

        $usuario->update($data);

        return redirect()
            ->route('usuarios.lista')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    // Excluir usuário
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        if ($usuario->public_id) {
            Storage::delete($usuario->public_id);
        }

        $usuario->delete();

        return redirect()
            ->route('usuarios.lista')
            ->with('success', 'Usuário excluído com sucesso!');
    }
}