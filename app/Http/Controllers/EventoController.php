<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoRequest;
use App\Models\Evento;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventoController extends Controller
{
    public function index(): View
    {
        $eventos = Evento::withCount('participantes')
            ->orderBy('fecha')
            ->orderBy('hora')
            ->paginate(10);

        return view('eventos.index', compact('eventos'));
    }

    public function create(): View
    {
        return view('eventos.create', ['tipos' => Evento::TIPOS]);
    }

    public function store(EventoRequest $request): RedirectResponse
    {
        Evento::create($request->validated());

        return redirect()->route('eventos.index')
            ->with('success', 'El evento se creó correctamente.');
    }

    public function show(Evento $evento): View
    {
        $evento->load('participantes');

        return view('eventos.show', compact('evento'));
    }

    public function edit(Evento $evento): View
    {
        return view('eventos.edit', ['evento' => $evento, 'tipos' => Evento::TIPOS]);
    }

    public function update(EventoRequest $request, Evento $evento): RedirectResponse
    {
        $inscritos = $evento->participantes()->count();

        if ($request->integer('cupo_maximo') < $inscritos) {
            return back()->withInput()->withErrors([
                'cupo_maximo' => "El cupo no puede ser menor a los {$inscritos} participantes ya inscritos.",
            ]);
        }

        $evento->update($request->validated());

        return redirect()->route('eventos.index')
            ->with('success', 'El evento se actualizó correctamente.');
    }

    public function destroy(Evento $evento): RedirectResponse
    {
        if ($evento->participantes()->exists()) {
            return redirect()->route('eventos.index')
                ->with('error', 'No se puede eliminar el evento porque tiene participantes inscritos.');
        }

        $evento->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'El evento se eliminó correctamente.');
    }
}
