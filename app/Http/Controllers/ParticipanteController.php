<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipanteRequest;
use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ParticipanteController extends Controller
{
    public function index(): View
    {
        $participantes = Participante::with('evento')
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->paginate(10);

        return view('participantes.index', compact('participantes'));
    }

    public function create(): View
    {
        return view('participantes.create', [
            'eventos' => Evento::orderBy('fecha')->get(),
        ]);
    }

    public function store(ParticipanteRequest $request): RedirectResponse
    {
        Participante::create($request->validated());

        return redirect()->route('participantes.index')
            ->with('success', 'El participante se inscribió correctamente.');
    }

    public function show(Participante $participante): View
    {
        $participante->load('evento');

        return view('participantes.show', compact('participante'));
    }

    public function edit(Participante $participante): View
    {
        return view('participantes.edit', [
            'participante' => $participante,
            'eventos' => Evento::orderBy('fecha')->get(),
        ]);
    }

    public function update(ParticipanteRequest $request, Participante $participante): RedirectResponse
    {
        $participante->update($request->validated());

        return redirect()->route('participantes.index')
            ->with('success', 'El participante se actualizó correctamente.');
    }

    public function destroy(Participante $participante): RedirectResponse
    {
        $participante->delete();

        return redirect()->route('participantes.index')
            ->with('success', 'El participante se eliminó correctamente.');
    }
}
