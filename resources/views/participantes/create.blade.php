@extends('layouts.app')
@section('title', 'Nuevo participante')

@section('content')
<h1 class="h3 mb-3">Nuevo participante</h1>
<div class="card shadow-sm"><div class="card-body">
    <form action="{{ route('participantes.store') }}" method="POST" novalidate>
        @csrf
        @include('participantes._form')
    </form>
</div></div>
@endsection
