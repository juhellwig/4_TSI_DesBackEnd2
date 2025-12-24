<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnderecoUserRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function teste_endereco_pertence_usuario()
    {
        $endereco = Endereco::factory()->create();

        $this->assertNotNull($endereco->user);
    }
}