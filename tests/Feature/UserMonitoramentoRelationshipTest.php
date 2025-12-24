<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Monitoramento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserMonitoramentoRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_many_monitoramentos_como_paciente()
    {
        $user = User::factory()->create();

        Monitoramento::factory()->create([
            'paciente_id'      => $user->id,
            'dt_monitoramento' => now(),
        ]);

        $user->refresh();

        $this->assertCount(1, $user->monitoramentosPaciente);
        $this->assertInstanceOf(
            Monitoramento::class,
            $user->monitoramentosPaciente->first()
        );
    }
}