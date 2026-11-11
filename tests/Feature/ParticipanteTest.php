<?php

namespace Tests\Feature;

use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParticipanteTest extends TestCase
{
    use RefreshDatabase;

    private function datos(Evento $evento, array $extra = []): array
    {
        return array_merge([
            'documento' => '1051234567',
            'nombres' => 'Laura',
            'apellidos' => 'Martínez',
            'correo' => 'laura@example.com',
            'telefono' => '3101234567',
            'evento_id' => $evento->id,
            'fecha_inscripcion' => '2026-11-05',
        ], $extra);
    }

    public function test_lista_los_participantes_con_su_evento(): void
    {
        $evento = Evento::factory()->create(['nombre' => 'Teatro en el Parque']);
        Participante::factory()->create(['evento_id' => $evento->id, 'nombres' => 'Marta']);

        $this->get(route('participantes.index'))
            ->assertOk()
            ->assertSee('Marta')
            ->assertSee('Teatro en el Parque');
    }

    public function test_inscribe_un_participante(): void
    {
        $evento = Evento::factory()->create();

        $this->post(route('participantes.store'), $this->datos($evento))
            ->assertRedirect(route('participantes.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('participantes', ['documento' => '1051234567', 'evento_id' => $evento->id]);
    }

    public function test_valida_campos_obligatorios_y_formatos(): void
    {
        $evento = Evento::factory()->create();

        $this->post(route('participantes.store'), [])
            ->assertSessionHasErrors(['documento', 'nombres', 'apellidos', 'correo', 'telefono', 'evento_id', 'fecha_inscripcion']);

        $this->post(route('participantes.store'), $this->datos($evento, ['correo' => 'no-es-correo', 'documento' => 'abc']))
            ->assertSessionHasErrors(['correo', 'documento']);
    }

    public function test_exige_un_evento_existente(): void
    {
        $evento = Evento::factory()->create();

        $this->post(route('participantes.store'), $this->datos($evento, ['evento_id' => 9999]))
            ->assertSessionHasErrors('evento_id');
    }

    public function test_no_permite_documentos_repetidos(): void
    {
        $evento = Evento::factory()->create();
        Participante::factory()->create(['documento' => '1051234567', 'evento_id' => $evento->id]);

        $this->post(route('participantes.store'), $this->datos($evento))
            ->assertSessionHasErrors('documento');
    }

    public function test_no_permite_inscribir_en_un_evento_sin_cupos(): void
    {
        $evento = Evento::factory()->create(['cupo_maximo' => 1]);
        Participante::factory()->create(['evento_id' => $evento->id]);

        $this->post(route('participantes.store'), $this->datos($evento))
            ->assertSessionHasErrors('evento_id');

        $this->assertDatabaseCount('participantes', 1);
    }

    public function test_actualiza_un_participante_sin_chocar_con_su_propio_documento(): void
    {
        $evento = Evento::factory()->create();
        $participante = Participante::factory()->create(['documento' => '1051234567', 'evento_id' => $evento->id]);

        $this->put(route('participantes.update', $participante), $this->datos($evento, ['nombres' => 'Nuevo']))
            ->assertRedirect(route('participantes.index'));

        $this->assertDatabaseHas('participantes', ['id' => $participante->id, 'nombres' => 'Nuevo']);
    }

    public function test_elimina_un_participante(): void
    {
        $participante = Participante::factory()->create();

        $this->delete(route('participantes.destroy', $participante))
            ->assertRedirect(route('participantes.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('participantes', ['id' => $participante->id]);
    }

    public function test_la_base_de_datos_impide_borrar_un_evento_con_participantes(): void
    {
        $participante = Participante::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);
        $participante->evento->delete();
    }
}
