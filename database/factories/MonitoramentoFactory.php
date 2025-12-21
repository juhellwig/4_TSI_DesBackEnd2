<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Monitoramento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Monitoramento>
 */
class MonitoramentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Monitoramento::class;

    public function definition(): array
    {
        $tipos = ['Diabetes', 'Hipertensao', 'Outra'];
        
        return [
            'dt_monitoramento' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'hora_monitoramento' => $this->faker->time('H:i:s'),
            'tipo' => $this->faker->randomElement($tipos),
            'observacoes' => $this->faker->paragraph(3),
        ];
    }
}
