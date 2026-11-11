@extends('layouts.app')
@section('title', 'Editar evento')

@section('content')
<h1 class="h3 mb-3">Editar evento</h1>
<div class="card shadow-sm"><div class="card-body">
    <form action="{{ route('eventos.update', $evento) }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        @include('eventos._form')
    </form>
</div></div>
@endsection
