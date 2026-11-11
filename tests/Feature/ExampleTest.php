<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * La página principal redirige al módulo de eventos.
     */
    public function test_la_pagina_principal_redirige_a_eventos(): void
    {
        $this->get('/')->assertRedirect('/eventos');
    }
}
