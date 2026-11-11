@extends('layouts.app')
@section('title', 'Editar participante')

@section('content')
<h1 class="h3 mb-3">Editar participante</h1>
<div class="card shadow-sm"><div class="card-body">
    <form action="{{ route('participantes.update', $participante) }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        @include('participantes._form')
    </form>
</div></div>
@endsection
