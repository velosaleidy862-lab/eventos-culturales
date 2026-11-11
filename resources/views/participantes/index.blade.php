@extends('layouts.app')
@section('title', 'Participantes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Participantes</h1>
    <a href="{{ route('participantes.create') }}" class="btn btn-primary"><i class="bi bi-person-plus"></i> Nuevo participante</a>
</div>

<div class="card shadow-sm"><div class="table-responsive">
    <table class="table table-striped table-hover align-middle mb-0">
        <thead class="table-dark">
        <tr>
            <th>Documento</th><th>Nombre completo</th><th>Correo</th><th>Teléfono</th>
            <th>Evento</th><th>Inscripción</th><th class="text-end">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($participantes as $p)
            <tr>
                <td>{{ $p->documento }}</td>
                <td>{{ $p->nombre_completo }}</td>
                <td>{{ $p->correo }}</td>
                <td>{{ $p->telefono }}</td>
                <td><a href="{{ route('eventos.show', $p->evento) }}">{{ $p->evento->nombre }}</a></td>
                <td>{{ $p->fecha_inscripcion->format('d/m/Y') }}</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('participantes.show', $p) }}" class="btn btn-sm btn-outline-secondary" title="Ver"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('participantes.edit', $p) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('participantes.destroy', $p) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Seguro que deseas eliminar a {{ $p->nombre_completo }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center text-muted py-4">Aún no hay participantes inscritos.</td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>

<div class="mt-3">{{ $participantes->links() }}</div>
@endsection
