<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSpecificSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //fixo
        User::factory()->profissional()->create([
            'name' => 'Profissional Teste',
            'email' => 'profissional@teste.com.br',
            'password' => Hash::make('password'), 
            'cpf' => '55544433322',
            'datacadastro' => now(),
            //'imagem' => 'https://placehold.co/200x200/2962ff/ffffff?text=PRO'
            'imagem' => null,
            'public_id' => null,
        ]);

        //fixo
        User::factory()->paciente()->create([
            'name' => 'Paciente Teste',
            'email' => 'paciente@teste.com.br',
            'password' => Hash::make('password'), 
            'cpf' => '11122233344',
            'datacadastro' => now(),
            //'imagem' => 'https://placehold.co/200x200/ff6d00/ffffff?text=PAC'
            'imagem' => null,
            'public_id' => null,
        ]);
        
        //dados aleatórios em massa
        User::factory(10)->paciente()->create();

        //dados aleatórios em massa
        User::factory(5)->profissional()->create();
    }
}