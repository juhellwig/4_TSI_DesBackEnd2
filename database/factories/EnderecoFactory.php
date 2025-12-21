<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Endereco;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Endereco::class;

    public function definition(): array
    {
        $cepSemHifen = str_replace('-', '', $this->faker->postcode());
        return [
            'cep' => $cepSemHifen, 
            'logradouro' => $this->faker->streetName(), 
            'numero' => $this->faker->numberBetween(1, 1000), 
            'complemento' => $this->faker->optional(0.5)->secondaryAddress(), 
            'bairro' => $this->faker->citySuffix(), 
            'cidade' => $this->faker->city(), 
            'estado' => $this->faker->stateAbbr(), 
            'pais' => $this->faker->country(), 
        ];
    }
}
