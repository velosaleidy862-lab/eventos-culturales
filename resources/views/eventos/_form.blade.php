@php($e = $evento ?? null)
<div class="row g-3">
    <div class="col-md-8">
        <label for="nombre" class="form-label">Nombre del evento *</label>
        <input type="text" id="nombre" name="nombre" maxlength="120"
               class="form-control @error('nombre') is-invalid @enderror"
               value="{{ old('nombre', $e?->nombre) }}" required>
        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label for="tipo" class="form-label">Tipo de evento *</label>
        <select id="tipo" name="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
            <option value="">Seleccione…</option>
            @foreach ($tipos as $tipo)
                <option value="{{ $tipo }}" @selected(old('tipo', $e?->tipo) === $tipo)>{{ $tipo }}</option>
            @endforeach
        </select>
        @error('tipo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label for="descripcion" class="form-label">Descripción *</label>
        <textarea id="descripcion" name="descripcion" rows="3" maxlength="1000"
                  class="form-control @error('descripcion') is-invalid @enderror" required>{{ old('descripcion', $e?->descripcion) }}</textarea>
        @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="lugar" class="form-label">Lugar *</label>
        <input type="text" id="lugar" name="lugar" maxlength="120"
               class="form-control @error('lugar') is-invalid @enderror"
               value="{{ old('lugar', $e?->lugar) }}" required>
        @error('lugar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-2">
        <label for="fecha" class="form-label">Fecha *</label>
        <input type="date" id="fecha" name="fecha"
               class="form-control @error('fecha') is-invalid @enderror"
               value="{{ old('fecha', $e?->fecha?->format('Y-m-d')) }}" required>
        @error('fecha')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-2">
        <label for="hora" class="form-label">Hora *</label>
        <input type="time" id="hora" name="hora"
               class="form-control @error('hora') is-invalid @enderror"
               value="{{ old('hora', $e ? substr($e->hora, 0, 5) : null) }}" required>
        @error('hora')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-2">
        <label for="cupo_maximo" class="form-label">Cupo máximo *</label>
        <input type="number" id="cupo_maximo" name="cupo_maximo" min="1"
               class="form-control @error('cupo_maximo') is-invalid @enderror"
               value="{{ old('cupo_maximo', $e?->cupo_maximo) }}" required>
        @error('cupo_maximo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar</button>
    <a href="{{ route('eventos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
</div>
