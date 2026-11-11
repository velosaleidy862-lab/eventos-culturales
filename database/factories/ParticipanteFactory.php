<?php

namespace Database\Factories;

use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Participante> */
class ParticipanteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'documento' => (string) fake()->unique()->numberBetween(10000000, 1999999999),
            'nombres' => fake()->firstName(),
            'apellidos' => fake()->lastName(),
            'correo' => fake()->unique()->safeEmail(),
            'telefono' => '3'.fake()->numerify('#########'),
            'evento_id' => Evento::factory(),
            'fecha_inscripcion' => now()->format('Y-m-d'),
        ];
    }
}
