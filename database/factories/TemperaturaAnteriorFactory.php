<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TemperaturaAnterior;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TemperaturaAnteriorFactory extends Factory
{
    protected $model = TemperaturaAnterior::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->randomElement(['Hondarribia']),
            'temperatura' => $this->faker->randomFloat(2, -4, 40.99),
            'humedad' => $this->faker->randomFloat(2, 0, 100),
            'tiempo' => $this->faker->randomElement(['Cloudy', 'Sunny', 'Rainy']),
            'viento' => $this->faker->randomFloat(2, 0, 150),
            'fecha' => $this->faker->unique()->dateTimeBetween('2023-01-01', '2023-12-31')->format('Y-m-d H:i'),
        ];
    }
}
