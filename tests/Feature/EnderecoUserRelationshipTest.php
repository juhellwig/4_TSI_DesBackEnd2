<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class EnderecoUserRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function teste_endereco_pertence_usuario()
    {
        $user = User::factory()->create();

    $endereco = Endereco::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->assertInstanceOf(User::class, $endereco->user);
    }
}