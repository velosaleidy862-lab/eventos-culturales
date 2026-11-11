<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EventoController extends Controller
{
    public function index(): View
    {
        $eventos = Evento::orderBy('fecha')->orderBy('hora')->paginate(10);

        return view('eventos.index', compact('eventos'));
    }

    public function create(): View
    {
        return view('eventos.create', ['tipos' => Evento::TIPOS]);
    }

    public function store(Request $request): RedirectResponse
    {
        Evento::create($this->validar($request));

        return redirect()->route('eventos.index')
            ->with('success', 'El evento se creó correctamente.');
    }

    public function show(Evento $evento): View
    {
        return view('eventos.show', compact('evento'));
    }

    public function edit(Evento $evento): View
    {
        return view('eventos.edit', ['evento' => $evento, 'tipos' => Evento::TIPOS]);
    }

    public function update(Request $request, Evento $evento): RedirectResponse
    {
        $evento->update($this->validar($request));

        return redirect()->route('eventos.index')
            ->with('success', 'El evento se actualizó correctamente.');
    }

    public function destroy(Evento $evento): RedirectResponse
    {
        $evento->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'El evento se eliminó correctamente.');
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'tipo' => ['required', Rule::in(Evento::TIPOS)],
            'descripcion' => ['required', 'string', 'max:1000'],
            'lugar' => ['required', 'string', 'max:120'],
            'fecha' => ['required', 'date'],
            'hora' => ['required', 'date_format:H:i'],
            'cupo_maximo' => ['required', 'integer', 'min:1', 'max:100000'],
        ]);
    }
}
