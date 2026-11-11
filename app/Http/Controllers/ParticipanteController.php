<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

    public function store(Request $request): RedirectResponse
    {
        Participante::create($this->validar($request));
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

    public function update(Request $request, Participante $participante): RedirectResponse
    {
        $participante->update($this->validar($request, $participante));
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

    private function validar(Request $request, ?Participante $participante = null): array
    {
        return $request->validate([
            'documento' => [
                'required', 'digits_between:5,15',
                Rule::unique('participantes', 'documento')->ignore($participante?->id),
            ],
            'nombres' => ['required', 'string', 'max:80'],
            'apellidos' => ['required', 'string', 'max:80'],
            'correo' => ['required', 'email', 'max:120'],
            'telefono' => ['required', 'digits_between:7,15'],
            'evento_id' => ['required', 'integer', 'exists:eventos,id'],
            'fecha_inscripcion' => ['required', 'date'],
        ]);
    }
}
