<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\CategoriaController;

Route::get('/', fn() => redirect()->route('chamados.index'));

Route::resource('chamados',  ChamadoController::class);
Route::resource('tecnicos',  TecnicoController::class);
Route::resource('categorias', CategoriaController::class);
