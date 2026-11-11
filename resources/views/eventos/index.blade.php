@extends('layouts.app')
@section('title', 'Eventos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Eventos culturales</h1>
    <a href="{{ route('eventos.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nuevo evento</a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Lugar</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th class="text-center">Inscritos / Cupo</th>
                <th class="text-end">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($eventos as $evento)
                <tr>
                    <td>{{ $evento->nombre }}</td>
                    <td><span class="badge text-bg-secondary">{{ $evento->tipo }}</span></td>
                    <td>{{ $evento->lugar }}</td>
                    <td>{{ $evento->fecha->format('d/m/Y') }}</td>
                    <td>{{ substr($evento->hora, 0, 5) }}</td>
                    <td class="text-center">{{ $evento->participantes_count }} / {{ $evento->cupo_maximo }}</td>
                    <td class="text-end text-nowrap">
                        <a href="{{ route('eventos.show', $evento) }}" class="btn btn-sm btn-outline-secondary" title="Ver"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('eventos.destroy', $evento) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Seguro que deseas eliminar el evento «{{ $evento->nombre }}»?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Aún no hay eventos registrados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $eventos->links() }}</div>
@endsection
