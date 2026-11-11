<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\ParticipanteController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/eventos');

Route::resource('eventos', EventoController::class);
Route::resource('participantes', ParticipanteController::class);
