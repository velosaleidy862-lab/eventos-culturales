<?php

namespace App\Http\Requests;

use App\Models\Evento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ParticipanteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $participante = $this->route('participante');

        return [
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
        ];
    }

    /**
     * Valida que el evento elegido todavía tenga cupos disponibles.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->has('evento_id')) {
                    return;
                }

                $evento = Evento::find($this->input('evento_id'));
                $participante = $this->route('participante');

                if (! $evento) {
                    return;
                }

                $cambiaDeEvento = ! $participante || $participante->evento_id !== $evento->id;

                if ($cambiaDeEvento && $evento->cuposDisponibles() < 1) {
                    $validator->errors()->add('evento_id', 'El evento seleccionado ya no tiene cupos disponibles.');
                }
            },
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute no puede superar :max caracteres.',
            'email' => 'El campo :attribute debe ser un correo válido.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'digits_between' => 'El campo :attribute debe contener solo números (entre :min y :max dígitos).',
            'unique' => 'Ya existe un participante registrado con ese :attribute.',
            'exists' => 'El evento seleccionado no existe.',
            'integer' => 'El campo :attribute no es válido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'documento' => 'documento',
            'nombres' => 'nombres',
            'apellidos' => 'apellidos',
            'correo' => 'correo',
            'telefono' => 'teléfono',
            'evento_id' => 'evento',
            'fecha_inscripcion' => 'fecha de inscripción',
        ];
    }
}
