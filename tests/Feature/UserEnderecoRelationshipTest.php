<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserEnderecoRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function teste_usuario_tem_um_endereco()
    {
        $user = User::factory()->create();

        $user->endereco()->create([
            'rua' => 'Rua Teste',
            'numero' => '123',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'cep' => '00000000',
        ]);

        $this->assertNotNull($user->endereco);
        $this->assertEquals('Rua Teste', $user->endereco->rua);
    }
}
