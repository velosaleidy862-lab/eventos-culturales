@extends('layouts.app')
@section('title', 'Nuevo evento')

@section('content')
<h1 class="h3 mb-3">Nuevo evento</h1>
<div class="card shadow-sm"><div class="card-body">
    <form action="{{ route('eventos.store') }}" method="POST" novalidate>
        @csrf
        @include('eventos._form')
    </form>
</div></div>
@endsection
