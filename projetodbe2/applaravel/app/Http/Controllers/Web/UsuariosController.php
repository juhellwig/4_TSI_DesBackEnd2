<?php

namespace App\Http\Controllers\Web;

use App\Models\Usuario;

class UsuariosController{
    public function listarUsuarios(){
        $listUsuarios = Usuario::all();
        return view('usuarios/usuarios', compact('listUsuarios'));
    }

    // Exibir formulário de criação
    public function create(){
        return view('usuarios.create');
    }

    public function store(){
    // Pega todos os dados do formulário
    $data = request()->all();

    // Trata o upload da imagem, se houver
    if(request()->hasFile('imagem')){
        $arquivo = request()->file('imagem');
        $nome = time().'_'.$arquivo->getClientOriginalName();
        $arquivo->move(public_path('imagens'), $nome);
        $data['imagem'] = $nome;
    } else {
        $data['imagem'] = '';
    }

    // Salva no banco
    Usuario::create($data);

    return redirect()->route('usuarios.lista')
                     ->with('success', 'Usuário cadastrado com sucesso!');
    }

    // Exibir formulário de edição
    public function edit($id){
        $usuario = Usuario::find($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Atualizar usuário
    public function update($id){
        $usuario = Usuario::find($id);
        $data = request()->all();

        // Upload de imagem se houver
        if(request()->hasFile('imagem')){
            $arquivo = request()->file('imagem');
            $nome = time().'_'.$arquivo->getClientOriginalName();
            $arquivo->move(public_path('imagens'), $nome);
            $data['imagem'] = $nome;
        } else {
            $data['imagem'] = $usuario->imagem; // mantém a imagem antiga
        }

        $usuario->update($data);

        return redirect()->route('usuarios.lista')
                        ->with('success', 'Usuário atualizado com sucesso!');
    }

    // Excluir usuário
    public function destroy($id){
        $usuario = Usuario::find($id);
        $usuario->delete();

        return redirect()->route('usuarios.lista')
                        ->with('success', 'Usuário excluído com sucesso!');
    }
}
