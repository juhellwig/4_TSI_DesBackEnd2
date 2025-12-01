<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipos = ['paciente', 'profissional', 'administrador'];

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'dtnasc' => $this->faker->date(),
            'sexo'  => $this->faker->randomElement(['M', 'F']),
            'cpf' => $this->faker->numerify('###########'),
            'telefone' => $this->faker->numerify('############'),
            // O tipo padrão é aleatório. Isso é sobrescrito pelos estados abaixo.
            'tipo_usuario' => $this->faker->randomElement($tipos), 
            'datacadastro' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'imagem' => $this->faker->imageUrl(200, 200, 'people', true, 'Faker Image'),
            
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    // --- FACTORY STATES (Para uso nos Seeders) ---

    /**
     * Estado: Indica que o usuário é um Administrador.
     */
    public function administrador(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'tipo_usuario' => 'administrador',
        ]);
    }

    /**
     * Estado: Indica que o usuário é um Profissional.
     */
    public function profissional(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'tipo_usuario' => 'profissional',
        ]);
    }

    /**
     * Estado: Indica que o usuário é um Paciente.
     */
    public function paciente(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'tipo_usuario' => 'paciente',
        ]);
    }
    
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
