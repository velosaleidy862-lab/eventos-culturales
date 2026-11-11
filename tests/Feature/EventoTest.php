<?php

namespace Tests\Feature;

use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventoTest extends TestCase
{
    use RefreshDatabase;

    private function datos(array $extra = []): array
    {
        return array_merge([
            'nombre' => 'Festival de Danza',
            'tipo' => 'Danza',
            'descripcion' => 'Muestra de danzas folclóricas.',
            'lugar' => 'Casa de la Cultura',
            'fecha' => '2026-12-12',
            'hora' => '19:00',
            'cupo_maximo' => 50,
        ], $extra);
    }

    public function test_la_raiz_redirige_al_listado_de_eventos(): void
    {
        $this->get('/')->assertRedirect('/eventos');
    }

    public function test_lista_los_eventos(): void
    {
        $evento = Evento::factory()->create(['nombre' => 'Cine al Parque']);

        $this->get(route('eventos.index'))
            ->assertOk()
            ->assertSee('Cine al Parque');
    }

    public function test_crea_un_evento(): void
    {
        $this->post(route('eventos.store'), $this->datos())
            ->assertRedirect(route('eventos.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('eventos', ['nombre' => 'Festival de Danza', 'cupo_maximo' => 50]);
    }

    public function test_valida_campos_obligatorios_y_tipos_de_dato(): void
    {
        $this->post(route('eventos.store'), [])
            ->assertSessionHasErrors(['nombre', 'tipo', 'descripcion', 'lugar', 'fecha', 'hora', 'cupo_maximo']);

        $this->post(route('eventos.store'), $this->datos(['cupo_maximo' => 'abc', 'fecha' => 'no-es-fecha']))
            ->assertSessionHasErrors(['cupo_maximo', 'fecha']);

        $this->assertDatabaseCount('eventos', 0);
    }

    public function test_actualiza_un_evento(): void
    {
        $evento = Evento::factory()->create();

        $this->put(route('eventos.update', $evento), $this->datos(['nombre' => 'Nombre nuevo']))
            ->assertRedirect(route('eventos.index'));

        $this->assertDatabaseHas('eventos', ['id' => $evento->id, 'nombre' => 'Nombre nuevo']);
    }

    public function test_no_permite_un_cupo_menor_a_los_inscritos(): void
    {
        $evento = Evento::factory()->create(['cupo_maximo' => 10]);
        Participante::factory()->count(3)->create(['evento_id' => $evento->id]);

        $this->put(route('eventos.update', $evento), $this->datos(['cupo_maximo' => 2]))
            ->assertSessionHasErrors('cupo_maximo');
    }

    public function test_elimina_un_evento_sin_participantes(): void
    {
        $evento = Evento::factory()->create();

        $this->delete(route('eventos.destroy', $evento))
            ->assertRedirect(route('eventos.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('eventos', ['id' => $evento->id]);
    }

    public function test_no_elimina_un_evento_con_participantes(): void
    {
        $evento = Evento::factory()->create();
        Participante::factory()->create(['evento_id' => $evento->id]);

        $this->delete(route('eventos.destroy', $evento))->assertSessionHas('error');

        $this->assertDatabaseHas('eventos', ['id' => $evento->id]);
    }
}
