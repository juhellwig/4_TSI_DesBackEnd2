<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Monitoramento;

class MonitoramentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pacienteIds = User::where('tipo_usuario', 'paciente')->pluck('id');
        $profissionalIds = User::where('tipo_usuario', 'profissional')->pluck('id');

        if ($pacienteIds->isEmpty() || $profissionalIds->isEmpty()) {
            $this->command->error('ERRO: Não há pacientes ou profissionais suficientes para criar monitoramentos. Verifique UserSpecificSeeder.');
            return;
        }

        foreach ($pacienteIds as $pacienteId) {
            
            $count = rand(1, 3);

            Monitoramento::factory($count)->create([
                'paciente_id' => $pacienteId,
                'profissional_id' => $profissionalIds->random(), 
            ]);
        }
        
        $this->command->info('Monitoramentos criados com sucesso e relacionados a pacientes e profissionais.');
    }
}