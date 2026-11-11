<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento', 'nombres', 'apellidos', 'correo', 'telefono',
        'evento_id', 'fecha_inscripcion',
    ];

    protected function casts(): array
    {
        return ['fecha_inscripcion' => 'date'];
    }

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return $this->nombres.' '.$this->apellidos;
    }
}
