<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Endereco;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id');

        foreach ($userIds as $userId) {
            
            if (!Endereco::where('user_id', $userId)->exists()) {
                Endereco::factory()->create([
                    'user_id' => $userId,
                ]);
            }
        }

        $this->command->info('Endereços criados com sucesso para todos os usuários.');
    }
}
