<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/eventos');

Route::resource('eventos', EventoController::class);
