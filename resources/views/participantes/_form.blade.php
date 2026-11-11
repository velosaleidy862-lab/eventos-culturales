@php($p = $participante ?? null)
<div class="row g-3">
    <div class="col-md-4">
        <label for="documento" class="form-label">Documento *</label>
        <input type="text" id="documento" name="documento" maxlength="15" inputmode="numeric"
               class="form-control @error('documento') is-invalid @enderror"
               value="{{ old('documento', $p?->documento) }}" required>
        @error('documento')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label for="nombres" class="form-label">Nombres *</label>
        <input type="text" id="nombres" name="nombres" maxlength="80"
               class="form-control @error('nombres') is-invalid @enderror"
               value="{{ old('nombres', $p?->nombres) }}" required>
        @error('nombres')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label for="apellidos" class="form-label">Apellidos *</label>
        <input type="text" id="apellidos" name="apellidos" maxlength="80"
               class="form-control @error('apellidos') is-invalid @enderror"
               value="{{ old('apellidos', $p?->apellidos) }}" required>
        @error('apellidos')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-5">
        <label for="correo" class="form-label">Correo *</label>
        <input type="email" id="correo" name="correo" maxlength="120"
               class="form-control @error('correo') is-invalid @enderror"
               value="{{ old('correo', $p?->correo) }}" required>
        @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label for="telefono" class="form-label">Teléfono *</label>
        <input type="text" id="telefono" name="telefono" maxlength="15" inputmode="tel"
               class="form-control @error('telefono') is-invalid @enderror"
               value="{{ old('telefono', $p?->telefono) }}" required>
        @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label for="fecha_inscripcion" class="form-label">Fecha de inscripción *</label>
        <input type="date" id="fecha_inscripcion" name="fecha_inscripcion"
               class="form-control @error('fecha_inscripcion') is-invalid @enderror"
               value="{{ old('fecha_inscripcion', $p?->fecha_inscripcion?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" required>
        @error('fecha_inscripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label for="evento_id" class="form-label">Evento inscrito *</label>
        <select id="evento_id" name="evento_id" class="form-select @error('evento_id') is-invalid @enderror" required>
            <option value="">Seleccione un evento…</option>
            @foreach ($eventos as $evento)
                <option value="{{ $evento->id }}" @selected((int) old('evento_id', $p?->evento_id) === $evento->id)>
                    {{ $evento->nombre }} — {{ $evento->fecha->format('d/m/Y') }}
                    {{ $evento->nombre }} — {{ $evento->fecha->format('d/m/Y') }} ({{ $evento->cuposDisponibles() }} cupos)
                </option>
            @endforeach
        </select>
        @error('evento_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar</button>
    <a href="{{ route('participantes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
</div>
