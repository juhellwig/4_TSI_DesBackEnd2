<?php

namespace App\Http\Controllers\Web;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController{
    //LISTAR

    public function listarEnderecos(){
        $listEnderecos = Endereco::orderBy('id')->get();
        return view('enderecos/enderecos', compact('listEnderecos'));
    }

    //CREATE

    public function create(){
        return view('enderecos.create');
    }

    // Salvar novo endereço
    public function store(Request $request){
        $request->validate([
            'cep' => 'required|size:8',
            'logradouro' => 'required|max:100',
            'numero' => 'required|integer',
            'complemento' => 'nullable|max:50',
            'bairro' => 'required|max:50',
            'cidade' => 'required|max:50',
            'estado' => 'required|size:2',
            'pais' => 'required|max:30',
        ]);

        // Criar registro
        Endereco::create($request->all());

        // Redirecionar para listagem com mensagem
        return redirect()->route('enderecos.lista')
                         ->with('success', 'Endereço cadastrado com sucesso!');
    }

    // UPDATE

    public function edit($id){
        $endereco = Endereco::findOrFail($id);
        return view('enderecos.edit', compact('endereco'));
    }

    // Atualizar registro no banco
    public function update(Request $request, $id){
        $endereco = Endereco::findOrFail($id);

        $request->validate([
            'cep' => 'required|size:8',
            'logradouro' => 'required|max:100',
            'numero' => 'required|integer',
            'complemento' => 'nullable|max:50',
            'bairro' => 'required|max:50',
            'cidade' => 'required|max:50',
            'estado' => 'required|size:2',
            'pais' => 'required|max:30',
        ]);

        $data = $request->all();
        $data['complemento'] = $data['complemento'] ?? ''; // caso seja nulo

        // Atualiza registro
        $endereco->update($data);

        // Redireciona para listagem
        return redirect()->route('enderecos.lista')
                         ->with('success', 'Endereço atualizado com sucesso!');
    }

    public function destroy($id){
    $endereco = Endereco::findOrFail($id);
    $endereco->delete();

    return redirect()->route('enderecos.lista')
                     ->with('success', 'Endereço excluído com sucesso!');
    }
}