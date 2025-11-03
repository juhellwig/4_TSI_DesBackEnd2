<?php

namespace App\Http\Controllers;

use App\Models\Monitoramentos;
use Illuminate\Http\Request;

class MonitoramentosController{
    // LISTAR

    public function listarMonitoramentos(){
        $listMonitoramentos = Monitoramentos::all();
        return view ('monitoramentos/monitoramentos', compact('listMonitoramentos'));
    }

    // CREATE

    public function create(){
        return view('monitoramentos.create');
    }

    // Salvar novo monitoramento
    public function store(Request $request){
        
        $request->validate([
            'dt_monitoramento' => 'required|date',
            'hora_monitoramento' => 'required',
            'tipo' => 'required|in:Diabetes,Hipertensao,Outra',
            'observacoes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['observacoes'] = $data['observacoes'] ?? '';

        // Criar registro
        Monitoramentos::create($data);

        // Redirecionar para listagem com mensagem
        return redirect()->route('monitoramentos.lista')
                         ->with('success', 'Monitoramento cadastrado com sucesso!');
    }

    // UPDATE

    public function edit($id){
        $monitoramento = Monitoramentos::findOrFail($id);
        return view('monitoramentos.edit', compact('monitoramento'));
    }

    public function update(Request $request, $id){
        $monitoramento = Monitoramentos::findOrFail($id);

        $request->validate([
            'dt_monitoramento' => 'required|date',
            'hora_monitoramento' => 'required',
            'tipo' => 'required|in:Diabetes,Hipertensao,Outra',
            'observacoes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['observacoes'] = $data['observacoes'] ?? '';

        $monitoramento->update($data);

        return redirect()->route('monitoramentos.lista')
                        ->with('success', 'Monitoramento atualizado com sucesso!');
    }

    // DELETE
    
    public function destroy($id){
        $monitoramento = Monitoramentos::findOrFail($id);
        $monitoramento->delete();

        return redirect()->route('monitoramentos.lista')
                        ->with('success', 'Monitoramento excluído com sucesso!');
    }
}
