<?php

namespace App\Http\Requests;

use App\Models\Evento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:120'],
            'tipo' => ['required', Rule::in(Evento::TIPOS)],
            'descripcion' => ['required', 'string', 'max:1000'],
            'lugar' => ['required', 'string', 'max:120'],
            'fecha' => ['required', 'date'],
            'hora' => ['required', 'date_format:H:i'],
            'cupo_maximo' => ['required', 'integer', 'min:1', 'max:100000'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute supera el máximo permitido (:max).',
            'min' => 'El campo :attribute debe ser como mínimo :min.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'date_format' => 'El campo :attribute debe tener el formato HH:MM.',
            'in' => 'El valor seleccionado en :attribute no es válido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre del evento',
            'tipo' => 'tipo de evento',
            'descripcion' => 'descripción',
            'lugar' => 'lugar',
            'fecha' => 'fecha',
            'hora' => 'hora',
            'cupo_maximo' => 'cupo máximo',
        ];
    }
}
