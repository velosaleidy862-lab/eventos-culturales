<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evento extends Model
{
    use HasFactory;

    public const TIPOS = [
        'Música', 'Danza', 'Teatro', 'Cine', 'Literatura',
        'Artes plásticas', 'Gastronomía', 'Otro',
    ];

    protected $fillable = [
        'nombre', 'tipo', 'descripcion', 'lugar', 'fecha', 'hora', 'cupo_maximo',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'cupo_maximo' => 'integer',
        ];
    }

    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class);
    }

    public function cuposDisponibles(): int
    {
        return max(0, $this->cupo_maximo - $this->participantes()->count());
    }
}
