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
        <dt class="col-sm-3">Cupo máximo</dt><dd class="col-sm-9">{{ $evento->cupo_maximo }} personas</dd>
    </dl>
</div></div>

@endsection
