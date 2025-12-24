<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Monitoramento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MonitoramentoUserRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_monitoramento_pertence_usuario()
    {
        $paciente = User::factory()->create();
        $profissional = User::factory()->create();

        $monitoramento = Monitoramento::create([
            'paciente_id' => $paciente->id,
            'profissional_id' => $profissional->id,
            'datahora_monitoramento' => now(),
            'tipo' => 'hipertensao',
            'observacoes' => 'Monitoramento teste',
        ]);

        $this->assertNotNull($monitoramento->paciente);
        $this->assertNotNull($monitoramento->profissional);
    }
}
