<?php

namespace Database\Seeders;

use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Database\Seeder;

class ParticipanteSeeder extends Seeder
{
    public function run(): void
    {
        $eventos = Evento::orderBy('fecha')->get();

        $personas = [
            ['1051234501', 'Andrea', 'Gómez Rojas', 'andrea.gomez@example.com', '3101234501'],
            ['1051234502', 'Carlos', 'Pérez Duarte', 'carlos.perez@example.com', '3101234502'],
            ['1051234503', 'Laura', 'Martínez Silva', 'laura.martinez@example.com', '3101234503'],
            ['1051234504', 'Juan', 'Rodríguez Peña', 'juan.rodriguez@example.com', '3101234504'],
            ['1051234505', 'Camila', 'Torres Ruiz', 'camila.torres@example.com', '3101234505'],
            ['1051234506', 'Diego', 'Ramírez León', 'diego.ramirez@example.com', '3101234506'],
            ['1051234507', 'Valentina', 'Castro Mora', 'valentina.castro@example.com', '3101234507'],
            ['1051234508', 'Sebastián', 'Herrera Díaz', 'sebastian.herrera@example.com', '3101234508'],
            ['1051234509', 'Daniela', 'Vargas Ortiz', 'daniela.vargas@example.com', '3101234509'],
            ['1051234510', 'Santiago', 'Núñez Cruz', 'santiago.nunez@example.com', '3101234510'],
        ];

        foreach ($personas as $i => [$documento, $nombres, $apellidos, $correo, $telefono]) {
            Participante::firstOrCreate(['documento' => $documento], [
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'telefono' => $telefono,
                'evento_id' => $eventos[$i % $eventos->count()]->id,
                'fecha_inscripcion' => '2026-11-0'.(($i % 9) + 1),
            ]);
        }
    }
}
