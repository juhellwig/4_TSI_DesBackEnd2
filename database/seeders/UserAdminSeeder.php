<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_pass = env('APP_ADMIN_PASS');
        
        if(empty($admin_pass))
            throw new Exception("ERRO: Admin Password!");

        User::factory()->administrador()->create([
            'name' => 'Admin User',
            'email' => 'juliana@admin.com.br',
            'tipo_usuario' => 'administrador',
            'is_admin' => true,
            'password' => Hash::make($admin_pass),
            //'imagem' => 'https://placehold.co/200x200/5cb85c/ffffff?text=ADM'
            'imagem' => null,
            'public_id' => null,
        ]);
    }
}
