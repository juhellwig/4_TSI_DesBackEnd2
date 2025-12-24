<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserEnderecoRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_tem_um_endereco()
    {
        $user = User::factory()->create();

        Endereco::factory()->create([
            'user_id'    => $user->id,
            'logradouro' => 'Rua Teste',
        ]);

        $user->refresh();

        $this->assertInstanceOf(Endereco::class, $user->endereco);
    }
}