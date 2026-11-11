<?php

namespace Database\Seeders;

use App\Models\Evento;
use Illuminate\Database\Seeder;

class EventoSeeder extends Seeder
{
    public function run(): void
    {
        $eventos = [
            ['Festival de Música del Magdalena', 'Música', 'Muestra de música tradicional y folclórica de la región con grupos locales.', 'Parque Principal de Puerto Boyacá', '2026-12-05', '18:00', 150],
            ['Noche de Danzas Folclóricas', 'Danza', 'Presentación de grupos de danza de las instituciones educativas del municipio.', 'Casa de la Cultura', '2026-12-12', '19:00', 80],
            ['Obra de Teatro: Memorias del Río', 'Teatro', 'Obra teatral que cuenta la historia de las comunidades ribereñas.', 'Auditorio Municipal', '2026-12-19', '17:30', 60],
            ['Cine al Parque', 'Cine', 'Proyección de cortometrajes colombianos al aire libre.', 'Parque Las Palmas', '2027-01-09', '19:30', 200],
            ['Encuentro de Escritores Locales', 'Literatura', 'Lectura de cuentos y poemas de escritores de la región.', 'Biblioteca Municipal', '2027-01-16', '16:00', 40],
        ];

        foreach ($eventos as [$nombre, $tipo, $descripcion, $lugar, $fecha, $hora, $cupo]) {
            Evento::firstOrCreate(['nombre' => $nombre], [
                'tipo' => $tipo,
                'descripcion' => $descripcion,
                'lugar' => $lugar,
                'fecha' => $fecha,
                'hora' => $hora,
                'cupo_maximo' => $cupo,
            ]);
        }
    }
}
