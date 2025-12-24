<?php

namespace App\Http\Controllers\Web;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use App\Models\User;

class UserController{
    public function listarUsuarios(){
        $listUsuarios = User::all();
        return view('usuarios/usuarios', compact('listUsuarios'));
    }

    // Exibir formulário de criação
    public function create(){
        return view('usuarios.create');
    }

    public function store(){
    // Pega todos os dados do formulário
    $data = request()->all();

    // Upload da imagem no Cloudinary
        if (request()->hasFile('imagem')) {

            $upload = Cloudinary::upload(
                request()->file('imagem')->getRealPath(),
                ['folder' => 'uploads/users']
            );

            $data['imagem'] = $upload->getSecurePath(); // URL
            $data['public_id'] = $upload->getPublicId(); // ID
        }

    // Salva no banco
    User::create($data);

    return redirect()->route('usuarios.lista')
                     ->with('success', 'Usuário cadastrado com sucesso!');
    }

    // Exibir formulário de edição
    public function edit($id){
        $usuario = User::find($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Atualizar usuário
    public function update($id){
        $usuario = User::find($id);
        $data = request()->all();

        // Upload de nova imagem
        if (request()->hasFile('imagem')) {

            // Remove imagem antiga do Cloudinary
            if (!empty($usuario->public_id)) {
                Cloudinary::destroy($usuario->public_id);
            }

            $upload = Cloudinary::upload(
                request()->file('imagem')->getRealPath(),
                ['folder' => 'uploads/users']
            );

            $data['imagem'] = $upload->getSecurePath();
            $data['public_id'] = $upload->getPublicId();
        } else {
            // Mantém imagem antiga
            $data['imagem'] = $usuario->imagem;
            $data['public_id'] = $usuario->public_id;
        }

        $usuario->update($data);

        return redirect()->route('usuarios.lista')
                        ->with('success', 'Usuário atualizado com sucesso!');
    }

    // Excluir usuário
    public function destroy($id){
        $usuario = User::find($id);

        // Remove imagem do Cloudinary
        if (!empty($usuario->public_id)) {
            Cloudinary::destroy($usuario->public_id);
        }
        
        $usuario->delete();

        return redirect()->route('usuarios.lista')
                        ->with('success', 'Usuário excluído com sucesso!');
    }
}
