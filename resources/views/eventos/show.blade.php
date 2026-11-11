@extends('layouts.app')
@section('title', $evento->nombre)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">{{ $evento->nombre }}</h1>
    <a href="{{ route('eventos.index') }}" class="btn btn-outline-secondary">Volver</a>
</div>

<div class="card shadow-sm mb-4"><div class="card-body">
    <dl class="row mb-0">
        <dt class="col-sm-3">Tipo</dt><dd class="col-sm-9">{{ $evento->tipo }}</dd>
        <dt class="col-sm-3">Descripción</dt><dd class="col-sm-9">{{ $evento->descripcion }}</dd>
        <dt class="col-sm-3">Lugar</dt><dd class="col-sm-9">{{ $evento->lugar }}</dd>
        <dt class="col-sm-3">Fecha y hora</dt><dd class="col-sm-9">{{ $evento->fecha->format('d/m/Y') }} a las {{ substr($evento->hora, 0, 5) }}</dd>
        <dt class="col-sm-3">Cupo</dt>
        <dd class="col-sm-9">{{ $evento->participantes->count() }} inscritos de {{ $evento->cupo_maximo }} ({{ $evento->cuposDisponibles() }} disponibles)</dd>
    </dl>
</div></div>

<h2 class="h5">Participantes inscritos</h2>
<div class="card shadow-sm"><div class="table-responsive">
    <table class="table table-striped mb-0">
        <thead class="table-dark"><tr><th>Documento</th><th>Nombre</th><th>Correo</th><th>Inscripción</th></tr></thead>
        <tbody>
        @forelse ($evento->participantes as $p)
            <tr>
                <td>{{ $p->documento }}</td>
                <td><a href="{{ route('participantes.show', $p) }}">{{ $p->nombre_completo }}</a></td>
                <td>{{ $p->correo }}</td>
                <td>{{ $p->fecha_inscripcion->format('d/m/Y') }}</td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted py-3">Sin participantes inscritos.</td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
@endsection
