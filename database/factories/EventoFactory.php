<?php

namespace Database\Factories;

use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Evento> */
class EventoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->sentence(3),
            'tipo' => fake()->randomElement(Evento::TIPOS),
            'descripcion' => fake()->paragraph(),
            'lugar' => fake()->words(3, true),
            'fecha' => fake()->dateTimeBetween('+1 week', '+3 months')->format('Y-m-d'),
            'hora' => fake()->time('H:i'),
            'cupo_maximo' => fake()->numberBetween(10, 200),
        ];
    }
}
