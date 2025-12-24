<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Monitoramento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MonitoramentoUserRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_monitoramento_pertence_ao_paciente()
    {
        $paciente = User::factory()->create();
        $profissional = User::factory()->create();

        $monitoramento = Monitoramento::factory()->create([
            'paciente_id' => $paciente->id,
            'profissional_id' => $profissional->id,
            'dt_monitoramento' => now(), // campo obrigatório
        ]);

        $this->assertInstanceOf(User::class, $monitoramento->paciente);
    }
}