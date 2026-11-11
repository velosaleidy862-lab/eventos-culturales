@extends('layouts.app')
@section('title', $participante->nombre_completo)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">{{ $participante->nombre_completo }}</h1>
    <a href="{{ route('participantes.index') }}" class="btn btn-outline-secondary">Volver</a>
</div>
<div class="card shadow-sm"><div class="card-body">
    <dl class="row mb-0">
        <dt class="col-sm-3">Documento</dt><dd class="col-sm-9">{{ $participante->documento }}</dd>
        <dt class="col-sm-3">Correo</dt><dd class="col-sm-9">{{ $participante->correo }}</dd>
        <dt class="col-sm-3">Teléfono</dt><dd class="col-sm-9">{{ $participante->telefono }}</dd>
        <dt class="col-sm-3">Evento</dt>
        <dd class="col-sm-9"><a href="{{ route('eventos.show', $participante->evento) }}">{{ $participante->evento->nombre }}</a></dd>
        <dt class="col-sm-3">Fecha de inscripción</dt><dd class="col-sm-9">{{ $participante->fecha_inscripcion->format('d/m/Y') }}</dd>
    </dl>
</div></div>
@endsection
